import { type HTMLAttributes } from 'react';
import { Clock, Users, Play, Trophy } from 'lucide-react';
import { Button } from '../../ui/Button';

interface StudentQuizCardProps extends HTMLAttributes<HTMLDivElement> {
  id: string;
  title: string;
  subject: string;
  instructor: string;
  duration: number;
  totalQuestions: number;
  enrolledStudents: number;
  maxStudents: number;
  status: 'active' | 'upcoming' | 'completed';
  hasAttempted?: boolean;
  score?: number;
  onEnroll: () => void;
  onStart: () => void;
  onViewResults: () => void;
}

export function StudentQuizCard({
  id,
  title,
  subject,
  instructor,
  duration,
  totalQuestions,
  enrolledStudents,
  maxStudents,
  status,
  hasAttempted,
  score,
  onEnroll,
  onStart,
  onViewResults,
  className = '',
}: StudentQuizCardProps) {
  return (
    <div className={`bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow ${className}`}>
      <h3 className="text-lg font-semibold text-gray-900 mb-2">{title}</h3>
      <p className="text-sm text-gray-600 mb-1">Subject: {subject}</p>
      <p className="text-sm text-gray-600 mb-4">Instructor: {instructor}</p>
      <div className="flex items-center gap-4 text-sm text-gray-500 mb-4">
        <span className="flex items-center gap-1">
          <Clock className="h-4 w-4" /> {duration} min
        </span>
        <span className="flex items-center gap-1">
          <Users className="h-4 w-4" /> {enrolledStudents}/{maxStudents}
        </span>
        <span className="text-sm text-gray-600">{totalQuestions} Questions</span>
      </div>
      {status === 'completed' && hasAttempted && (
        <p className="text-sm text-gray-600 mb-4">Your Score: {score}%</p>
      )}
      <div className="flex gap-2">
        {status === 'upcoming' && !hasAttempted && (
          <Button onClick={onEnroll} variant="outline">
            Enroll
          </Button>
        )}
        {status === 'active' && !hasAttempted && (
          <Button onClick={onStart}>
            <Play className="h-4 w-4 mr-2" /> Start Quiz
          </Button>
        )}
        {(status === 'completed' || hasAttempted) && (
          <Button onClick={onViewResults} variant="outline">
            <Trophy className="h-4 w-4 mr-2" /> View Results
          </Button>
        )}
      </div>
    </div>
  );
}