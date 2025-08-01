import { type HTMLAttributes } from 'react';
import { Settings, User } from 'lucide-react';

interface StaffDashboardHeaderProps extends HTMLAttributes<HTMLDivElement> {
  userRole: 'Faculty' | 'Admin';
  userName: string;
  userAvatar: string;
}

export function StaffDashboardHeader({ userRole, userName, userAvatar, className }: StaffDashboardHeaderProps) {
  return (
    <header className={`bg-white shadow-sm ${className}`}>
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <h1 className="text-xl font-semibold text-gray-900">Staff Quiz Dashboard</h1>
        <div className="flex items-center gap-4">
          <div className="flex items-center gap-2">
            <img src={userAvatar} alt="User Avatar" className="h-8 w-8 rounded-full" />
            <span className="text-sm font-medium text-gray-700">{userName} ({userRole})</span>
          </div>
          <button className="p-2 hover:bg-gray-100 rounded-full">
            <Settings className="h-5 w-5 text-gray-600" />
          </button>
        </div>
      </div>
    </header>
  );
}