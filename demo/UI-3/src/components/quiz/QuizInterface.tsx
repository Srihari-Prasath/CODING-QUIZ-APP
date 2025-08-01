import { useState, useEffect } from "react";
import { QuizTimer } from "./QuizTimer";
import { Button } from "@/components/ui/button";
import { Card } from "@/components/ui/card";
import { Progress } from "@/components/ui/progress";
import { Badge } from "@/components/ui/badge";
import { 
  ChevronLeft, 
  ChevronRight, 
  Flag, 
  CheckCircle, 
  Circle,
  AlertTriangle,
  Send
} from "lucide-react";

interface QuizQuestion {
  id: string;
  question: string;
  options: string[];
  correctAnswer?: number;
  selectedAnswer?: number;
  isFlagged?: boolean;
}

interface QuizInterfaceProps {
  quizTitle: string;
  questions: QuizQuestion[];
  duration: number; // in minutes
  onSubmit: (answers: Record<string, number>) => void;
}

export function QuizInterface({ quizTitle, questions, duration, onSubmit }: QuizInterfaceProps) {
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [answers, setAnswers] = useState<Record<string, number>>({});
  const [flaggedQuestions, setFlaggedQuestions] = useState<Set<string>>(new Set());
  const [showSubmitDialog, setShowSubmitDialog] = useState(false);

  const handleAnswerSelect = (optionIndex: number) => {
    setAnswers(prev => ({
      ...prev,
      [questions[currentQuestion].id]: optionIndex
    }));
  };

  const handleFlagToggle = () => {
    const questionId = questions[currentQuestion].id;
    setFlaggedQuestions(prev => {
      const newSet = new Set(prev);
      if (newSet.has(questionId)) {
        newSet.delete(questionId);
      } else {
        newSet.add(questionId);
      }
      return newSet;
    });
  };

  const handleSubmit = () => {
    onSubmit(answers);
  };

  const handleTimeUp = () => {
    handleSubmit();
  };

  const goToQuestion = (index: number) => {
    setCurrentQuestion(index);
  };

  const nextQuestion = () => {
    if (currentQuestion < questions.length - 1) {
      setCurrentQuestion(currentQuestion + 1);
    }
  };

  const prevQuestion = () => {
    if (currentQuestion > 0) {
      setCurrentQuestion(currentQuestion - 1);
    }
  };

  const getQuestionStatus = (questionId: string, index: number) => {
    const isAnswered = answers[questionId] !== undefined;
    const isFlagged = flaggedQuestions.has(questionId);
    const isCurrent = index === currentQuestion;

    if (isCurrent) return 'current';
    if (isFlagged) return 'flagged';
    if (isAnswered) return 'answered';
    return 'unanswered';
  };

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'current': return 'bg-primary text-primary-foreground';
      case 'answered': return 'bg-success text-success-foreground';
      case 'flagged': return 'bg-warning text-warning-foreground';
      default: return 'bg-muted text-muted-foreground';
    }
  };

  const answeredCount = Object.keys(answers).length;
  const progress = (answeredCount / questions.length) * 100;

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <div className="bg-card border-b border-border shadow-soft">
        <div className="max-w-7xl mx-auto px-4 py-4">
          <div className="flex justify-between items-center">
            <div>
              <h1 className="text-xl font-bold text-foreground">{quizTitle}</h1>
              <p className="text-sm text-muted-foreground">
                Question {currentQuestion + 1} of {questions.length}
              </p>
            </div>
            <QuizTimer duration={duration} onTimeUp={handleTimeUp} />
          </div>
          
          {/* Progress */}
          <div className="mt-4">
            <div className="flex justify-between text-sm text-muted-foreground mb-2">
              <span>Progress: {answeredCount}/{questions.length} answered</span>
              <span>{Math.round(progress)}% complete</span>
            </div>
            <Progress value={progress} className="h-2" />
          </div>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 py-6">
        <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
          {/* Question Panel */}
          <div className="lg:col-span-3">
            <Card className="p-6">
              <div className="flex justify-between items-start mb-6">
                <div className="flex-1">
                  <div className="flex items-center gap-2 mb-4">
                    <Badge variant="outline">Question {currentQuestion + 1}</Badge>
                    {flaggedQuestions.has(questions[currentQuestion].id) && (
                      <Badge className="status-badge-pending">
                        <Flag className="h-3 w-3 mr-1" />
                        Flagged
                      </Badge>
                    )}
                  </div>
                  <h2 className="text-lg font-semibold text-foreground mb-6">
                    {questions[currentQuestion].question}
                  </h2>
                </div>
                <Button
                  variant="ghost"
                  size="sm"
                  onClick={handleFlagToggle}
                  className={flaggedQuestions.has(questions[currentQuestion].id) ? 'text-warning' : ''}
                >
                  <Flag className="h-4 w-4" />
                </Button>
              </div>

              {/* Options */}
              <div className="space-y-3 mb-6">
                {questions[currentQuestion].options.map((option, index) => (
                  <label
                    key={index}
                    className={`flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all hover:bg-accent ${
                      answers[questions[currentQuestion].id] === index
                        ? 'border-primary bg-primary/5'
                        : 'border-border'
                    }`}
                  >
                    <input
                      type="radio"
                      name={`question-${currentQuestion}`}
                      value={index}
                      checked={answers[questions[currentQuestion].id] === index}
                      onChange={() => handleAnswerSelect(index)}
                      className="sr-only"
                    />
                    <div className="flex items-center gap-3">
                      {answers[questions[currentQuestion].id] === index ? (
                        <CheckCircle className="h-5 w-5 text-primary" />
                      ) : (
                        <Circle className="h-5 w-5 text-muted-foreground" />
                      )}
                      <span className="text-foreground">{option}</span>
                    </div>
                  </label>
                ))}
              </div>

              {/* Navigation */}
              <div className="flex justify-between items-center pt-6 border-t border-border">
                <Button
                  variant="outline"
                  onClick={prevQuestion}
                  disabled={currentQuestion === 0}
                >
                  <ChevronLeft className="h-4 w-4 mr-2" />
                  Previous
                </Button>

                <div className="flex gap-2">
                  {currentQuestion === questions.length - 1 ? (
                    <Button
                      variant="hero"
                      onClick={() => setShowSubmitDialog(true)}
                      className="px-8"
                    >
                      <Send className="h-4 w-4 mr-2" />
                      Submit Quiz
                    </Button>
                  ) : (
                    <Button variant="default" onClick={nextQuestion}>
                      Next
                      <ChevronRight className="h-4 w-4 ml-2" />
                    </Button>
                  )}
                </div>
              </div>
            </Card>
          </div>

          {/* Question Palette */}
          <div className="lg:col-span-1">
            <Card className="p-4 sticky top-6">
              <h3 className="font-semibold text-foreground mb-4">Question Palette</h3>
              <div className="grid grid-cols-5 gap-2 mb-4">
                {questions.map((question, index) => {
                  const status = getQuestionStatus(question.id, index);
                  return (
                    <button
                      key={question.id}
                      onClick={() => goToQuestion(index)}
                      className={`aspect-square flex items-center justify-center text-sm font-medium rounded transition-all hover:scale-105 ${getStatusColor(status)}`}
                    >
                      {index + 1}
                    </button>
                  );
                })}
              </div>

              {/* Legend */}
              <div className="space-y-2 text-xs">
                <div className="flex items-center gap-2">
                  <div className="w-3 h-3 bg-success rounded"></div>
                  <span>Answered</span>
                </div>
                <div className="flex items-center gap-2">
                  <div className="w-3 h-3 bg-warning rounded"></div>
                  <span>Flagged</span>
                </div>
                <div className="flex items-center gap-2">
                  <div className="w-3 h-3 bg-muted rounded"></div>
                  <span>Not Answered</span>
                </div>
                <div className="flex items-center gap-2">
                  <div className="w-3 h-3 bg-primary rounded"></div>
                  <span>Current</span>
                </div>
              </div>

              {/* Stats */}
              <div className="mt-6 pt-4 border-t border-border">
                <div className="space-y-2 text-sm">
                  <div className="flex justify-between">
                    <span>Answered:</span>
                    <span className="font-medium">{answeredCount}</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Flagged:</span>
                    <span className="font-medium">{flaggedQuestions.size}</span>
                  </div>
                  <div className="flex justify-between">
                    <span>Remaining:</span>
                    <span className="font-medium">{questions.length - answeredCount}</span>
                  </div>
                </div>
              </div>
            </Card>
          </div>
        </div>
      </div>

      {/* Submit Confirmation Dialog */}
      {showSubmitDialog && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <Card className="max-w-md mx-4 p-6">
            <div className="text-center">
              <AlertTriangle className="mx-auto h-12 w-12 text-warning mb-4" />
              <h3 className="text-lg font-semibold mb-2">Submit Quiz?</h3>
              <p className="text-muted-foreground mb-6">
                You have answered {answeredCount} out of {questions.length} questions.
                {questions.length - answeredCount > 0 && (
                  <span className="block mt-1 text-warning">
                    {questions.length - answeredCount} questions remain unanswered.
                  </span>
                )}
              </p>
              <div className="flex gap-3">
                <Button
                  variant="outline"
                  onClick={() => setShowSubmitDialog(false)}
                  className="flex-1"
                >
                  Review
                </Button>
                <Button
                  variant="hero"
                  onClick={handleSubmit}
                  className="flex-1"
                >
                  Submit
                </Button>
              </div>
            </div>
          </Card>
        </div>
      )}
    </div>
  );
}