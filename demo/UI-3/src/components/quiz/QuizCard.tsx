import { Clock, Users, Calendar, BookOpen, Play, CheckCircle, AlertCircle } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";

interface QuizCardProps {
  id: string;
  title: string;
  subject: string;
  instructor: string;
  duration: number; // in minutes
  totalQuestions: number;
  enrolledStudents: number;
  maxStudents: number;
  startDate: string;
  endDate: string;
  status: 'upcoming' | 'active' | 'completed' | 'expired';
  hasAttempted?: boolean;
  score?: number;
  onEnroll?: () => void;
  onStart?: () => void;
  onViewResults?: () => void;
}

export function QuizCard({
  id,
  title,
  subject,
  instructor,
  duration,
  totalQuestions,
  enrolledStudents,
  maxStudents,
  startDate,
  endDate,
  status,
  hasAttempted = false,
  score,
  onEnroll,
  onStart,
  onViewResults
}: QuizCardProps) {
  const getStatusBadge = () => {
    switch (status) {
      case 'upcoming':
        return <Badge className="status-badge-pending">Upcoming</Badge>;
      case 'active':
        return <Badge className="status-badge-active">Active</Badge>;
      case 'completed':
        return <Badge className="status-badge-completed">Completed</Badge>;
      case 'expired':
        return <Badge variant="secondary">Expired</Badge>;
      default:
        return null;
    }
  };

  const getActionButton = () => {
    if (status === 'expired') {
      return (
        <Button variant="secondary" disabled className="w-full">
          <AlertCircle className="mr-2 h-4 w-4" />
          Expired
        </Button>
      );
    }

    if (hasAttempted) {
      return (
        <Button variant="outline" onClick={onViewResults} className="w-full">
          <CheckCircle className="mr-2 h-4 w-4" />
          View Results {score !== undefined && `(${score}%)`}
        </Button>
      );
    }

    if (status === 'active') {
      return (
        <Button variant="hero" onClick={onStart} className="w-full">
          <Play className="mr-2 h-4 w-4" />
          Start Quiz
        </Button>
      );
    }

    if (status === 'upcoming') {
      const isFullyBooked = enrolledStudents >= maxStudents;
      return (
        <Button
          variant={isFullyBooked ? "secondary" : "default"}
          onClick={onEnroll}
          disabled={isFullyBooked}
          className="w-full"
        >
          {isFullyBooked ? "Fully Booked" : "Enroll Now"}
        </Button>
      );
    }

    return null;
  };

  return (
    <div className="quiz-card group">
      <div className="flex justify-between items-start mb-4">
        <div className="flex-1">
          <div className="flex items-center gap-2 mb-2">
            <h3 className="text-lg font-semibold text-foreground group-hover:text-primary transition-colors">
              {title}
            </h3>
            {getStatusBadge()}
          </div>
          <p className="text-sm text-muted-foreground mb-1">{subject}</p>
          <p className="text-sm text-muted-foreground">By {instructor}</p>
        </div>
      </div>

      <div className="grid grid-cols-2 gap-4 mb-4">
        <div className="flex items-center text-sm text-muted-foreground">
          <Clock className="mr-2 h-4 w-4 text-primary" />
          {duration} minutes
        </div>
        <div className="flex items-center text-sm text-muted-foreground">
          <BookOpen className="mr-2 h-4 w-4 text-primary" />
          {totalQuestions} questions
        </div>
        <div className="flex items-center text-sm text-muted-foreground">
          <Users className="mr-2 h-4 w-4 text-primary" />
          {enrolledStudents}/{maxStudents} enrolled
        </div>
        <div className="flex items-center text-sm text-muted-foreground">
          <Calendar className="mr-2 h-4 w-4 text-primary" />
          {new Date(startDate).toLocaleDateString()}
        </div>
      </div>

      <div className="pt-4 border-t border-border">
        {getActionButton()}
      </div>
    </div>
  );
}