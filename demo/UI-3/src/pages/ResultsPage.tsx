import { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { QuizResults } from "@/components/quiz/QuizResults";

interface StoredResults {
  quizId: string;
  score: number;
  correctCount: number;
  totalQuestions: number;
  answers: Record<string, number>;
  questions: Array<{
    id: string;
    question: string;
    options: string[];
    correctAnswer: number;
  }>;
}

export default function ResultsPage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [results, setResults] = useState<StoredResults | null>(null);

  useEffect(() => {
    // Get results from sessionStorage
    const storedResults = sessionStorage.getItem('quizResults');
    if (storedResults) {
      const parsedResults = JSON.parse(storedResults);
      if (parsedResults.quizId === id) {
        setResults(parsedResults);
      } else {
        // Redirect to dashboard if no valid results found
        navigate('/dashboard');
      }
    } else {
      navigate('/dashboard');
    }
  }, [id, navigate]);

  const handleReturnToDashboard = () => {
    sessionStorage.removeItem('quizResults');
    navigate('/dashboard');
  };

  const handleDownloadCertificate = () => {
    // Mock certificate download
    console.log('Downloading certificate...');
  };

  const handleReviewAnswers = () => {
    // Mock review functionality
    console.log('Reviewing answers...');
  };

  if (!results) {
    return (
      <div className="min-h-screen bg-background flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-4"></div>
          <p className="text-muted-foreground">Loading results...</p>
        </div>
      </div>
    );
  }

  // Calculate additional metrics
  const wrongAnswers = results.totalQuestions - results.correctCount;
  const unanswered = results.totalQuestions - Object.keys(results.answers).length;
  const percentage = results.score;
  const passed = percentage >= 60; // 60% passing grade

  // Mock time spent calculation
  const timeSpent = "45 min 30 sec";

  const quizResult = {
    quizTitle: "Data Structures & Algorithms",
    totalQuestions: results.totalQuestions,
    correctAnswers: results.correctCount,
    wrongAnswers,
    unanswered,
    score: results.correctCount,
    percentage,
    timeSpent,
    passed,
    questions: results.questions.map(q => ({
      ...q,
      selectedAnswer: results.answers[q.id],
      isCorrect: results.answers[q.id] === q.correctAnswer
    }))
  };

  return (
    <QuizResults
      result={quizResult}
      onReturnToDashboard={handleReturnToDashboard}
      onDownloadCertificate={handleDownloadCertificate}
      onReviewAnswers={handleReviewAnswers}
    />
  );
}