import { useState, type HTMLAttributes } from 'react';
import { Button } from '../../ui/Button';
import { Input } from '../../ui/Input';
import { useToast } from '../../../hooks/use-toast';
import { Plus, X } from 'lucide-react';

interface Question {
  text: string;
  options: string[];
  correctAnswer: string;
}

interface StaffQuizUploadFormProps extends HTMLAttributes<HTMLDivElement> {
  onSubmit: (quiz: { title: string; subject: string; duration: number; questions: Question[] }) => void;
}

export function StaffQuizUploadForm({ onSubmit, className }: StaffQuizUploadFormProps) {
  const { toast } = useToast();
  const [title, setTitle] = useState('');
  const [subject, setSubject] = useState('');
  const [duration, setDuration] = useState('');
  const [questions, setQuestions] = useState<Question[]>([{ text: '', options: ['', '', '', ''], correctAnswer: '' }]);

  const addQuestion = () => {
    setQuestions([...questions, { text: '', options: ['', '', '', ''], correctAnswer: '' }]);
  };

  const updateQuestion = (index: number, field: keyof Question, value: string | string[]) => {
    const newQuestions = [...questions];
    newQuestions[index] = { ...newQuestions[index], [field]: value };
    setQuestions(newQuestions);
  };

  const removeQuestion = (index: number) => {
    setQuestions(questions.filter((_, i) => i !== index));
  };

  const handleSubmit = () => {
    if (!title || !subject || !duration || questions.some(q => !q.text || q.options.some(o => !o) || !q.correctAnswer)) {
      toast({
        title: 'Error',
        description: 'Please fill all fields.',
      });
      return;
    }

    onSubmit({
      title,
      subject,
      duration: parseInt(duration),
      questions,
    });

    toast({
      title: 'Quiz Uploaded',
      description: 'The quiz has been successfully uploaded.',
    });

    // Reset form
    setTitle('');
    setSubject('');
    setDuration('');
    setQuestions([{ text: '', options: ['', '', '', ''], correctAnswer: '' }]);
  };

  return (
    <div className={`bg-white rounded-lg shadow-md p-6 ${className}`}>
      <h2 className="text-xl font-semibold text-gray-900 mb-4">Upload New Quiz</h2>
      <div className="space-y-4">
        <Input
          placeholder="Quiz Title"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          className="w-full"
        />
        <Input
          placeholder="Subject"
          value={subject}
          onChange={(e) => setSubject(e.target.value)}
          className="w-full"
        />
        <Input
          type="number"
          placeholder="Duration (minutes)"
          value={duration}
          onChange={(e) => setDuration(e.target.value)}
          className="w-full"
        />
        {questions.map((question, qIndex) => (
          <div key={qIndex} className="border-t pt-4 mt-4">
            <div className="flex justify-between items-center mb-2">
              <h3 className="text-lg font-medium text-gray-900">Question {qIndex + 1}</h3>
              {questions.length > 1 && (
                <button onClick={() => removeQuestion(qIndex)} className="text-red-500 hover:text-red-600">
                  <X className="h-5 w-5" />
                </button>
              )}
            </div>
            <Input
              placeholder="Question Text"
              value={question.text}
              onChange={(e) => updateQuestion(qIndex, 'text', e.target.value)}
              className="mb-2"
            />
            {question.options.map((option, oIndex) => (
              <Input
                key={oIndex}
                placeholder={`Option ${oIndex + 1}`}
                value={option}
                onChange={(e) => {
                  const newOptions = [...question.options];
                  newOptions[oIndex] = e.target.value;
                  updateQuestion(qIndex, 'options', newOptions);
                }}
                className="mb-2"
              />
            ))}
            <Input
              placeholder="Correct Answer"
              value={question.correctAnswer}
              onChange={(e) => updateQuestion(qIndex, 'correctAnswer', e.target.value)}
              className="mb-2"
            />
          </div>
        ))}
        <Button onClick={addQuestion} variant="outline" className="w-full">
          <Plus className="h-4 w-4 mr-2" /> Add Question
        </Button>
        <Button onClick={handleSubmit} className="w-full">
          Upload Quiz
        </Button>
      </div>
    </div>
  );
}