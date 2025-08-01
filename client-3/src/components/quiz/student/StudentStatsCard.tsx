import { type HTMLAttributes } from 'react';
import { type LucideIcon } from 'lucide-react';

interface StudentStatsCardProps extends HTMLAttributes<HTMLDivElement> {
  title: string;
  value: string | number;
  description: string;
  icon: LucideIcon;
}

export function StudentStatsCard({ title, value, description, icon: Icon, className }: StudentStatsCardProps) {
  return (
    <div className={`bg-white rounded-lg shadow-md p-6 ${className}`}>
      <div className="flex items-center gap-4">
        <Icon className="h-8 w-8 text-blue-500" />
        <div>
          <h3 className="text-lg font-semibold text-gray-900">{title}</h3>
          <p className="text-2xl font-bold text-gray-900">{value}</p>
          <p className="text-sm text-gray-600">{description}</p>
        </div>
      </div>
    </div>
  );
}