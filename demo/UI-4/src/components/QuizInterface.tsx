import { useState, useEffect } from "react";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Progress } from "@/components/ui/progress";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import { Label } from "@/components/ui/label";
import { 
  Clock, 
  ArrowLeft, 
  ArrowRight, 
  CheckCircle, 
  Circle, 
  Pause,
  AlertTriangle,
  RotateCcw
} from "lucide-react";

interface QuizInterfaceProps {
  onBack: () => void;
  onComplete: () => void;
}

export const QuizInterface = ({ onBack, onComplete }: QuizInterfaceProps) => {
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [answers, setAnswers] = useState<{ [key: number]: string }>({});
  const [timeLeft, setTimeLeft] = useState(1800); // 30 minutes
  const [showSubmitDialog, setShowSubmitDialog] = useState(false);

  // Mock quiz data
  const quiz = {
    title: "Data Structures and Algorithms",
    description: "Comprehensive test on fundamental DSA concepts",
    totalQuestions: 20,
    duration: 30, // minutes
    questions: [
      {
        id: 1,
        question: "What is the time complexity of binary search in a sorted array?",
        options: [
          "O(n)",
          "O(log n)",
          "O(n log n)",
          "O(1)"
        ],
        type: "single"
      },
      {
        id: 2,
        question: "Which data structure uses LIFO (Last In, First Out) principle?",
        options: [
          "Queue",
          "Stack",
          "Linked List",
          "Array"
        ],
        type: "single"
      },
      {
        id: 3,
        question: "What is the worst-case time complexity of quicksort?",
        options: [
          "O(n)",
          "O(n log n)",
          "O(n²)",
          "O(log n)"
        ],
        type: "single"
      },
      // Add more questions as needed
    ]
  };

  // Timer effect
  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft((prev) => {
        if (prev <= 1) {
          clearInterval(timer);
          setShowSubmitDialog(true);
          return 0;
        }
        return prev - 1;
      });
    }, 1000);

    return () => clearInterval(timer);
  }, []);

  const formatTime = (seconds: number) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  };

  const handleAnswerChange = (value: string) => {
    setAnswers(prev => ({
      ...prev,
      [currentQuestion]: value
    }));
  };

  const getQuestionStatus = (index: number) => {
    if (index === currentQuestion) return 'current';
    if (answers[index]) return 'answered';
    return 'unanswered';
  };

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'current': return 'bg-quiz-current text-white';
      case 'answered': return 'bg-quiz-answered text-white';
      case 'skipped': return 'bg-quiz-skipped text-white';
      default: return 'bg-quiz-unanswered text-foreground';
    }
  };

  const navigateToQuestion = (index: number) => {
    setCurrentQuestion(index);
  };

  const nextQuestion = () => {
    if (currentQuestion < quiz.questions.length - 1) {
      setCurrentQuestion(currentQuestion + 1);
    }
  };

  const previousQuestion = () => {
    if (currentQuestion > 0) {
      setCurrentQuestion(currentQuestion - 1);
    }
  };

  const calculateProgress = () => {
    const answeredCount = Object.keys(answers).length;
    return (answeredCount / quiz.questions.length) * 100;
  };

  const handleSubmit = () => {
    onComplete();
  };

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <div className="border-b border-border bg-card shadow-sm">
        <div className="px-6 py-4">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-4">
              <Button variant="ghost" size="icon" onClick={onBack}>
                <ArrowLeft className="h-4 w-4" />
              </Button>
              <div>
                <h1 className="text-xl font-bold">{quiz.title}</h1>
                <p className="text-sm text-muted-foreground">{quiz.description}</p>
              </div>
            </div>
            <div className="flex items-center gap-4">
              <div className="flex items-center gap-2 text-lg font-mono">
                <Clock className="h-5 w-5 text-warning" />
                <span className={timeLeft < 300 ? 'text-destructive animate-pulse' : 'text-foreground'}>
                  {formatTime(timeLeft)}
                </span>
              </div>
              <Button variant="outline" size="sm">
                <Pause className="h-4 w-4" />
                Pause
              </Button>
            </div>
          </div>
        </div>
      </div>

      <div className="flex">
        {/* Question Navigator */}
        <div className="w-80 border-r border-border bg-card/50 min-h-screen p-6">
          <div className="space-y-6">
            <div>
              <h3 className="font-semibold mb-4">Quiz Progress</h3>
              <div className="space-y-2">
                <div className="flex justify-between text-sm">
                  <span>Answered: {Object.keys(answers).length}/{quiz.questions.length}</span>
                  <span>{Math.round(calculateProgress())}%</span>
                </div>
                <Progress value={calculateProgress()} className="h-2" />
              </div>
            </div>

            <div>
              <h3 className="font-semibold mb-4">Questions</h3>
              <div className="grid grid-cols-4 gap-2">
                {Array.from({ length: quiz.questions.length }, (_, index) => {
                  const status = getQuestionStatus(index);
                  return (
                    <button
                      key={index}
                      onClick={() => navigateToQuestion(index)}
                      className={`aspect-square rounded-lg text-sm font-medium transition-all duration-200 hover:scale-105 ${getStatusColor(status)}`}
                    >
                      {index + 1}
                    </button>
                  );
                })}
              </div>
            </div>

            <div className="space-y-3">
              <div className="flex items-center gap-2 text-sm">
                <div className="w-4 h-4 bg-quiz-current rounded"></div>
                <span>Current</span>
              </div>
              <div className="flex items-center gap-2 text-sm">
                <div className="w-4 h-4 bg-quiz-answered rounded"></div>
                <span>Answered</span>
              </div>
              <div className="flex items-center gap-2 text-sm">
                <div className="w-4 h-4 bg-quiz-unanswered rounded border"></div>
                <span>Not Answered</span>
              </div>
            </div>
          </div>
        </div>

        {/* Main Question Area */}
        <div className="flex-1 p-6">
          <div className="mx-auto max-w-4xl">
            <Card className="animate-fade-in">
              <CardHeader>
                <div className="flex items-center justify-between">
                  <Badge variant="secondary">
                    Question {currentQuestion + 1} of {quiz.questions.length}
                  </Badge>
                  <Badge variant="outline">Single Choice</Badge>
                </div>
                <CardTitle className="text-xl leading-relaxed">
                  {quiz.questions[currentQuestion]?.question}
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-6">
                <RadioGroup
                  value={answers[currentQuestion] || ""}
                  onValueChange={handleAnswerChange}
                  className="space-y-4"
                >
                  {quiz.questions[currentQuestion]?.options.map((option, index) => (
                    <div key={index} className="flex items-center space-x-3 p-4 rounded-lg border border-border hover:bg-secondary/50 transition-colors">
                      <RadioGroupItem value={option} id={`option-${index}`} />
                      <Label htmlFor={`option-${index}`} className="flex-1 cursor-pointer text-base">
                        {option}
                      </Label>
                    </div>
                  ))}
                </RadioGroup>

                <div className="flex items-center justify-between pt-6 border-t border-border">
                  <Button
                    variant="outline"
                    onClick={previousQuestion}
                    disabled={currentQuestion === 0}
                  >
                    <ArrowLeft className="h-4 w-4" />
                    Previous
                  </Button>

                  <div className="flex gap-3">
                    <Button variant="outline">
                      <RotateCcw className="h-4 w-4" />
                      Clear Answer
                    </Button>
                    
                    {currentQuestion === quiz.questions.length - 1 ? (
                      <Button variant="success" onClick={() => setShowSubmitDialog(true)}>
                        <CheckCircle className="h-4 w-4" />
                        Submit Quiz
                      </Button>
                    ) : (
                      <Button onClick={nextQuestion}>
                        Next
                        <ArrowRight className="h-4 w-4" />
                      </Button>
                    )}
                  </div>
                </div>
              </CardContent>
            </Card>

            {/* Submit Dialog */}
            {showSubmitDialog && (
              <div className="fixed inset-0 bg-background/80 backdrop-blur-sm z-50 flex items-center justify-center">
                <Card className="w-full max-w-md animate-fade-in">
                  <CardHeader>
                    <CardTitle className="flex items-center gap-2">
                      <AlertTriangle className="h-5 w-5 text-warning" />
                      Submit Quiz
                    </CardTitle>
                    <CardDescription>
                      Are you sure you want to submit your quiz? This action cannot be undone.
                    </CardDescription>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-4">
                      <div className="grid grid-cols-2 gap-4 text-sm">
                        <div>
                          <span className="text-muted-foreground">Answered:</span>
                          <p className="font-medium">{Object.keys(answers).length}/{quiz.questions.length}</p>
                        </div>
                        <div>
                          <span className="text-muted-foreground">Time Left:</span>
                          <p className="font-medium">{formatTime(timeLeft)}</p>
                        </div>
                      </div>
                      <div className="flex gap-3">
                        <Button
                          variant="outline"
                          className="flex-1"
                          onClick={() => setShowSubmitDialog(false)}
                        >
                          Continue Quiz
                        </Button>
                        <Button
                          variant="success"
                          className="flex-1"
                          onClick={handleSubmit}
                        >
                          Submit Now
                        </Button>
                      </div>
                    </div>
                  </CardContent>
                </Card>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};