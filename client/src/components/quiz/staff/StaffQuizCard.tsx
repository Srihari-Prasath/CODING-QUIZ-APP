import { type HTMLAttributes } from 'react';
import { Clock, Users } from 'lucide-react';
import { Button } from '../../ui/Button';

interface StaffQuizCardProps extends HTMLAttributes<HTMLDivElement> {
  id: string;
  title: string;
  subject: string;
  instructor: string;
  duration: number;
  totalQuestions: number;
  enrolledStudents: number;
  maxStudents: number;
  onViewDetails: () => void;
  onViewResults: () => void;
}

export function StaffQuizCard({
  id,
  title,
  subject,
  instructor,
  duration,
  totalQuestions,
  enrolledStudents,
  maxStudents,
  onViewDetails,
  onViewResults,
  className,
}: StaffQuizCardProps) {
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
      </div>
      <div className="flex gap-2">
        <Button onClick={onViewDetails} variant="outline">
          View Details
        </Button>
        <Button onClick={onViewResults} variant="outline">
          View Results
        </Button>
      </div>
    </div>
  );
}