import { type HTMLAttributes } from 'react';
import { User } from 'lucide-react';

interface StudentDashboardHeaderProps extends HTMLAttributes<HTMLDivElement> {
  userName: string;
  userAvatar: string;
}

export function StudentDashboardHeader({ userName, userAvatar, className }: StudentDashboardHeaderProps) {
  return (
    <header className={`bg-white shadow-sm ${className}`}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <h1 className="text-xl font-semibold text-gray-900">Student Quiz Dashboard</h1>
        <div className="flex items-center gap-2">
          <img src={userAvatar} alt="User Avatar" className="h-8 w-8 rounded-full" />
          <span className="text-sm font-medium text-gray-700">{userName} (Student)</span>
        </div>
      </div>
    </header>
  );
}