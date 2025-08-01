import { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { Button } from '@/components/ui/Button';
import { Input } from '@/components/ui/Input';
import { useToast } from '@/hooks/use-toast';
import { Clock, ArrowLeft, Send } from 'lucide-react';

const mockQuizzes = [
  {
    id: '1',
    title: 'Data Structures & Algorithms',
    subject: 'Computer Science',
    duration: 90,
    totalQuestions: 50,
    questions: [
      {
        id: 'q1',
        text: 'What is the time complexity of a binary search?',
        options: ['O(n)', 'O(log n)', 'O(n²)', 'O(1)'],
        correctAnswer: 'O(log n)',
      },
      {
        id: 'q2',
        text: 'Which data structure uses LIFO?',
        options: ['Queue', 'Stack', 'Array', 'Linked List'],
        correctAnswer: 'Stack',
      },
    ],
  },
  {
    id: '2',
    title: 'React Fundamentals',
    subject: 'Web Development',
    duration: 60,
    totalQuestions: 30,
    questions: [
      {
        id: 'q1',
        text: 'What is a React component?',
        options: [
          'A function or class that returns JSX',
          'A CSS stylesheet',
          'A database query',
          'A server endpoint',
        ],
        correctAnswer: 'A function or class that returns JSX',
      },
    ],
  },
  {
    id: '3',
    title: 'Database Management',
    subject: 'Computer Science',
    duration: 120,
    totalQuestions: 40,
    questions: [
      {
        id: 'q1',
        text: 'What does SQL stand for?',
        options: [
          'Structured Query Language',
          'Simple Query Language',
          'Sequential Query Language',
          'Standard Query Logic',
        ],
        correctAnswer: 'Structured Query Language',
      },
    ],
  },
];

export default function QuizPage() {
  const { quizId } = useParams();
  const navigate = useNavigate();
  const { toast } = useToast();
  const [userRole, setUserRole] = useState<'Student' | 'Faculty' | 'Admin'>('Student');
  const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
  const [answers, setAnswers] = useState<{ [key: string]: string }>({});
  const [timeLeft, setTimeLeft] = useState<number | null>(null);
  const [quiz, setQuiz] = useState<(typeof mockQuizzes)[0] | null>(null);

  useEffect(() => {
    const storedRole = localStorage.getItem('userRole') as 'Student' | 'Faculty' | 'Admin';
    if (storedRole) setUserRole(storedRole);

    const selectedQuiz = mockQuizzes.find((q) => q.id === quizId);
    if (selectedQuiz) {
      setQuiz(selectedQuiz);
      setTimeLeft(selectedQuiz.duration * 60);
    } else {
      toast({
        title: 'Error',
        description: 'Quiz not found.',
      });
      navigate('/dashboard');
    }
  }, [quizId, navigate, toast]);

  useEffect(() => {
    if (timeLeft === null || timeLeft <= 0 || userRole !== 'Student') return;

    const timer = setInterval(() => {
      setTimeLeft((prev) => {
        if (prev === null || prev <= 1) {
          clearInterval(timer);
          handleSubmit();
          return 0;
        }
        return prev - 1;
      });
    }, 1000);

    return () => clearInterval(timer);
  }, [timeLeft, userRole]);

  const handleAnswerSelect = (questionId: string, answer: string) => {
    setAnswers((prev) => ({ ...prev, [questionId]: answer }));
  };

  const handleSubmit = () => {
    if (userRole !== 'Student') return;

    const score = quiz?.questions.reduce((acc, q) => {
      return answers[q.id] === q.correctAnswer ? acc + 1 : acc;
    }, 0);
    const percentage = quiz ? (score! / quiz.questions.length) * 100 : 0;

    toast({
      title: 'Quiz Submitted',
      description: `Your score: ${score}/${quiz?.questions.length} (${percentage.toFixed(2)}%)`,
    });
    navigate(`/results/${quizId}`);
  };

  const formatTime = (seconds: number) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
  };

  if (userRole !== 'Student' && quiz) {
    return (
      <div className="min-h-screen bg-gray-100">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <div className="flex items-center justify-between mb-6">
            <div className="flex items-center gap-4">
              <Button variant="outline" onClick={() => navigate('/dashboard')}>
                <ArrowLeft className="h-4 w-4 mr-2" /> Back to Dashboard
              </Button>
              <h1 className="text-3xl font-bold text-gray-900">{quiz.title}</h1>
            </div>
          </div>
          <div className="bg-white rounded-lg shadow-md p-6">
            <h2 className="text-xl font-semibold text-gray-900 mb-4">Quiz Details</h2>
            <p className="text-gray-600 mb-2"><strong>Subject:</strong> {quiz.subject}</p>
            <p className="text-gray-600 mb-2"><strong>Duration:</strong> {quiz.duration} minutes</p>
            <p className="text-gray-600 mb-2"><strong>Total Questions:</strong> {quiz.totalQuestions}</p>
            <h3 className="text-lg font-semibold text-gray-900 mt-6 mb-4">Questions</h3>
            {quiz.questions.map((q, index) => (
              <div key={q.id} className="mb-6">
                <p className="text-gray-900 font-medium">{index + 1}. {q.text}</p>
                <ul className="list-disc pl-6 mt-2">
                  {q.options.map((option, i) => (
                    <li key={i} className={`text-gray-600 ${option === q.correctAnswer ? 'font-bold text-green-600' : ''}`}>
                      {option}
                    </li>
                  ))}
                </ul>
              </div>
            ))}
          </div>
        </div>
      </div>
    );
  }

  if (!quiz || !quiz.questions.length) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-gray-100">
        <div className="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
          <h1 className="text-2xl font-bold mb-6 text-center text-gray-900">Loading...</h1>
          <p className="text-center text-gray-600">Fetching quiz data...</p>
        </div>
      </div>
    );
  }

  const currentQuestion = quiz.questions[currentQuestionIndex];

  return (
    <div className="min-h-screen bg-gray-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="flex items-center justify-between mb-6">
          <div className="flex items-center gap-4">
            <Button variant="outline" onClick={() => navigate('/dashboard')}>
              <ArrowLeft className="h-4 w-4 mr-2" /> Back to Dashboard
            </Button>
            <h1 className="text-3xl font-bold text-gray-900">{quiz.title}</h1>
          </div>
          <div className="flex items-center gap-2 text-gray-600">
            <Clock className="h-5 w-5" />
            <span>{timeLeft !== null ? formatTime(timeLeft) : 'N/A'}</span>
          </div>
        </div>
        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex justify-between items-center mb-4">
            <h2 className="text-xl font-semibold text-gray-900">
              Question {currentQuestionIndex + 1} of {quiz.questions.length}
            </h2>
            <span className="text-sm text-gray-600">
              {quiz.subject} | {quiz.duration} min
            </span>
          </div>
          <p className="text-lg text-gray-900 mb-6">{currentQuestion.text}</p>
          <div className="space-y-4">
            {currentQuestion.options.map((option, index) => (
              <label
                key={index}
                className={`flex items-center p-4 rounded-md border ${
                  answers[currentQuestion.id] === option
                    ? 'border-blue-500 bg-blue-50'
                    : 'border-gray-200 hover:bg-gray-50'
                } cursor-pointer`}
              >
                <Input
                  type="radio"
                  name={`question-${currentQuestion.id}`}
                  value={option}
                  checked={answers[currentQuestion.id] === option}
                  onChange={() => handleAnswerSelect(currentQuestion.id, option)}
                  className="mr-3"
                />
                <span className="text-gray-900">{option}</span>
              </label>
            ))}
          </div>
          <div className="flex justify-between mt-8">
            <Button
              variant="outline"
              onClick={() => setCurrentQuestionIndex((prev) => Math.max(0, prev - 1))}
              disabled={currentQuestionIndex === 0}
            >
              Previous
            </Button>
            <div className="flex gap-2">
              {currentQuestionIndex < quiz.questions.length - 1 ? (
                <Button
                  onClick={() => setCurrentQuestionIndex((prev) => prev + 1)}
                  disabled={!answers[currentQuestion.id]}
                >
                  Next
                </Button>
              ) : (
                <Button onClick={handleSubmit} disabled={!answers[currentQuestion.id]}>
                  <Send className="h-4 w-4 mr-2" /> Submit Quiz
                </Button>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}