import { Trophy, CheckCircle, XCircle, Clock, Download, RotateCcw } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Card } from "@/components/ui/card";
import { Progress } from "@/components/ui/progress";
import { Badge } from "@/components/ui/badge";

interface QuizResult {
  quizTitle: string;
  totalQuestions: number;
  correctAnswers: number;
  wrongAnswers: number;
  unanswered: number;
  score: number;
  percentage: number;
  timeSpent: string;
  passed: boolean;
  questions: Array<{
    id: string;
    question: string;
    options: string[];
    correctAnswer: number;
    selectedAnswer?: number;
    isCorrect: boolean;
  }>;
}

interface QuizResultsProps {
  result: QuizResult;
  onReturnToDashboard: () => void;
  onDownloadCertificate?: () => void;
  onReviewAnswers: () => void;
}

export function QuizResults({ 
  result, 
  onReturnToDashboard, 
  onDownloadCertificate,
  onReviewAnswers 
}: QuizResultsProps) {
  const getScoreColor = () => {
    if (result.percentage >= 80) return 'text-success';
    if (result.percentage >= 60) return 'text-warning';
    return 'text-destructive';
  };

  const getScoreBadgeVariant = () => {
    if (result.passed) return 'default';
    return 'destructive';
  };

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <div className="bg-card border-b border-border shadow-soft">
        <div className="max-w-4xl mx-auto px-4 py-6">
          <div className="text-center">
            <div className="flex justify-center mb-4">
              <div className={`p-4 rounded-full ${result.passed ? 'bg-success/10' : 'bg-destructive/10'}`}>
                <Trophy className={`h-12 w-12 ${result.passed ? 'text-success' : 'text-destructive'}`} />
              </div>
            </div>
            <h1 className="text-3xl font-bold text-foreground mb-2">Quiz Completed!</h1>
            <p className="text-muted-foreground">{result.quizTitle}</p>
          </div>
        </div>
      </div>

      <div className="max-w-4xl mx-auto px-4 py-8">
        {/* Score Overview */}
        <Card className="p-8 mb-8 text-center">
          <div className="mb-6">
            <div className={`text-6xl font-bold mb-2 ${getScoreColor()}`}>
              {result.percentage}%
            </div>
            <div className="flex justify-center mb-4">
              <Badge 
                variant={getScoreBadgeVariant()}
                className="text-lg px-4 py-2"
              >
                {result.passed ? '🎉 Passed' : '❌ Failed'}
              </Badge>
            </div>
            <p className="text-muted-foreground">
              You scored {result.score} out of {result.totalQuestions} questions correctly
            </p>
          </div>

          <div className="mb-6">
            <Progress value={result.percentage} className="h-3 mb-2" />
            <p className="text-sm text-muted-foreground">Score Breakdown</p>
          </div>

          {/* Action Buttons */}
          <div className="flex flex-wrap justify-center gap-4">
            <Button variant="default" onClick={onReturnToDashboard}>
              <RotateCcw className="mr-2 h-4 w-4" />
              Return to Dashboard
            </Button>
            <Button variant="outline" onClick={onReviewAnswers}>
              View Detailed Review
            </Button>
            {onDownloadCertificate && result.passed && (
              <Button variant="success" onClick={onDownloadCertificate}>
                <Download className="mr-2 h-4 w-4" />
                Download Certificate
              </Button>
            )}
          </div>
        </Card>

        {/* Detailed Statistics */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <Card className="p-6 text-center">
            <div className="flex justify-center mb-3">
              <CheckCircle className="h-8 w-8 text-success" />
            </div>
            <div className="text-2xl font-bold text-success mb-1">
              {result.correctAnswers}
            </div>
            <p className="text-sm text-muted-foreground">Correct Answers</p>
          </Card>

          <Card className="p-6 text-center">
            <div className="flex justify-center mb-3">
              <XCircle className="h-8 w-8 text-destructive" />
            </div>
            <div className="text-2xl font-bold text-destructive mb-1">
              {result.wrongAnswers}
            </div>
            <p className="text-sm text-muted-foreground">Wrong Answers</p>
          </Card>

          <Card className="p-6 text-center">
            <div className="flex justify-center mb-3">
              <Clock className="h-8 w-8 text-warning" />
            </div>
            <div className="text-2xl font-bold text-foreground mb-1">
              {result.timeSpent}
            </div>
            <p className="text-sm text-muted-foreground">Time Spent</p>
          </Card>
        </div>

        {/* Performance Feedback */}
        <Card className="p-6">
          <h3 className="text-lg font-semibold text-foreground mb-4">Performance Analysis</h3>
          
          <div className="space-y-4">
            {result.percentage >= 90 && (
              <div className="p-4 bg-success/10 border border-success/20 rounded-lg">
                <h4 className="font-medium text-success mb-2">🌟 Excellent Performance!</h4>
                <p className="text-sm text-muted-foreground">
                  Outstanding work! You've demonstrated excellent understanding of the material.
                </p>
              </div>
            )}

            {result.percentage >= 70 && result.percentage < 90 && (
              <div className="p-4 bg-primary/10 border border-primary/20 rounded-lg">
                <h4 className="font-medium text-primary mb-2">👍 Good Performance!</h4>
                <p className="text-sm text-muted-foreground">
                  Well done! You have a solid grasp of the concepts. Review the incorrect answers to improve further.
                </p>
              </div>
            )}

            {result.percentage >= 50 && result.percentage < 70 && (
              <div className="p-4 bg-warning/10 border border-warning/20 rounded-lg">
                <h4 className="font-medium text-warning mb-2">⚠️ Needs Improvement</h4>
                <p className="text-sm text-muted-foreground">
                  You're on the right track, but there's room for improvement. Consider reviewing the study materials.
                </p>
              </div>
            )}

            {result.percentage < 50 && (
              <div className="p-4 bg-destructive/10 border border-destructive/20 rounded-lg">
                <h4 className="font-medium text-destructive mb-2">📚 Additional Study Needed</h4>
                <p className="text-sm text-muted-foreground">
                  Don't worry! Use this as a learning opportunity. Review the material and consider retaking the quiz.
                </p>
              </div>
            )}
          </div>

          {/* Quick Review */}
          <div className="mt-6 pt-6 border-t border-border">
            <h4 className="font-medium text-foreground mb-4">Quick Review</h4>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div className="text-sm">
                <span className="text-muted-foreground">Attempted:</span>
                <span className="ml-2 font-medium">
                  {result.totalQuestions - result.unanswered}/{result.totalQuestions}
                </span>
              </div>
              <div className="text-sm">
                <span className="text-muted-foreground">Accuracy:</span>
                <span className="ml-2 font-medium">
                  {result.totalQuestions - result.unanswered > 0 
                    ? Math.round((result.correctAnswers / (result.totalQuestions - result.unanswered)) * 100)
                    : 0}%
                </span>
              </div>
            </div>
          </div>
        </Card>
      </div>
    </div>
  );
}