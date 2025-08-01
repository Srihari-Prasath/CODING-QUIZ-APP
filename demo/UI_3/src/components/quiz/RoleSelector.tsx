import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Card } from "@/components/ui/card";
import { 
  GraduationCap, 
  BookOpen, 
  Shield, 
  Users, 
  ClipboardList, 
  Crown 
} from "lucide-react";

interface Role {
  id: string;
  title: string;
  description: string;
  icon: React.ElementType;
  features: string[];
  color: string;
}

const roles: Role[] = [
  {
    id: 'student',
    title: 'Student',
    description: 'Take quizzes, view results, and track progress',
    icon: GraduationCap,
    features: [
      'Enroll in available quizzes',
      'Real-time quiz interface',
      'View detailed results',
      'Track performance analytics',
      'Download certificates'
    ],
    color: 'from-blue-500 to-blue-600'
  },
  {
    id: 'faculty',
    title: 'Faculty',
    description: 'Create questions, manage quizzes, and evaluate students',
    icon: BookOpen,
    features: [
      'Question bank management',
      'Create and edit quizzes',
      'Monitor live attempts',
      'Manual evaluation tools',
      'Grade analytics'
    ],
    color: 'from-green-500 to-green-600'
  },
  {
    id: 'admin',
    title: 'Admin',
    description: 'Full system administration and quiz management',
    icon: Shield,
    features: [
      'Complete quiz CRUD operations',
      'User management',
      'System monitoring',
      'Report generation',
      'Bulk operations'
    ],
    color: 'from-purple-500 to-purple-600'
  },
  {
    id: 'hod',
    title: 'HOD',
    description: 'Department oversight and faculty management',
    icon: Users,
    features: [
      'Department quiz analytics',
      'Faculty performance review',
      'Approve quiz publications',
      'Resource allocation',
      'Strategic planning'
    ],
    color: 'from-orange-500 to-orange-600'
  },
  {
    id: 'secretary',
    title: 'Secretary',
    description: 'Administrative coordination and scheduling',
    icon: ClipboardList,
    features: [
      'Schedule management',
      'Communication coordination',
      'Policy implementation',
      'Event planning',
      'Documentation'
    ],
    color: 'from-teal-500 to-teal-600'
  },
  {
    id: 'vice-principal',
    title: 'Vice Principal',
    description: 'Strategic oversight and institutional management',
    icon: Crown,
    features: [
      'Global analytics dashboard',
      'Institution-wide reports',
      'Strategic decision support',
      'Quality assurance',
      'Stakeholder reporting'
    ],
    color: 'from-red-500 to-red-600'
  }
];

interface RoleSelectorProps {
  onRoleSelect: (roleId: string) => void;
}

export function RoleSelector({ onRoleSelect }: RoleSelectorProps) {
  const [selectedRole, setSelectedRole] = useState<string | null>(null);

  const handleRoleClick = (roleId: string) => {
    setSelectedRole(roleId);
  };

  const handleContinue = () => {
    if (selectedRole) {
      onRoleSelect(selectedRole);
    }
  };

  return (
    <div className="min-h-screen bg-gradient-hero flex items-center justify-center p-4">
      <div className="max-w-6xl w-full">
        <div className="text-center mb-12">
          <div className="w-20 h-20 gradient-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
            <span className="text-white font-bold text-2xl">QN</span>
          </div>
          <h1 className="text-4xl font-bold text-white mb-4">
            Welcome to Quiz Nexus Pro
          </h1>
          <p className="text-xl text-white/80 max-w-2xl mx-auto">
            Choose your role to access personalized features and dashboard tailored to your needs
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
          {roles.map((role) => {
            const Icon = role.icon;
            const isSelected = selectedRole === role.id;
            
            return (
              <Card
                key={role.id}
                className={`p-6 cursor-pointer transition-all duration-300 hover:scale-105 ${
                  isSelected 
                    ? 'ring-4 ring-white/50 shadow-glow bg-white' 
                    : 'bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white'
                } ${isSelected ? 'animate-pulse-glow' : ''}`}
                onClick={() => handleRoleClick(role.id)}
              >
                <div className="text-center mb-4">
                  <div className={`w-16 h-16 rounded-2xl bg-gradient-to-r ${role.color} flex items-center justify-center mx-auto mb-4`}>
                    <Icon className="h-8 w-8 text-white" />
                  </div>
                  <h3 className={`text-xl font-bold mb-2 ${isSelected ? 'text-foreground' : 'text-white'}`}>
                    {role.title}
                  </h3>
                  <p className={`text-sm mb-4 ${isSelected ? 'text-muted-foreground' : 'text-white/70'}`}>
                    {role.description}
                  </p>
                </div>

                <div className="space-y-2">
                  <h4 className={`text-sm font-semibold mb-2 ${isSelected ? 'text-foreground' : 'text-white'}`}>
                    Key Features:
                  </h4>
                  <ul className="space-y-1">
                    {role.features.slice(0, 3).map((feature, index) => (
                      <li 
                        key={index} 
                        className={`text-xs flex items-center ${isSelected ? 'text-muted-foreground' : 'text-white/60'}`}
                      >
                        <div className={`w-1.5 h-1.5 rounded-full mr-2 ${isSelected ? 'bg-primary' : 'bg-white/60'}`} />
                        {feature}
                      </li>
                    ))}
                    {role.features.length > 3 && (
                      <li className={`text-xs ${isSelected ? 'text-muted-foreground' : 'text-white/60'}`}>
                        +{role.features.length - 3} more features
                      </li>
                    )}
                  </ul>
                </div>

                {isSelected && (
                  <div className="mt-4 pt-4 border-t border-border">
                    <div className="flex items-center justify-center">
                      <span className="text-primary font-medium text-sm">✓ Selected</span>
                    </div>
                  </div>
                )}
              </Card>
            );
          })}
        </div>

        <div className="text-center">
          <Button
            variant="hero"
            size="lg"
            onClick={handleContinue}
            disabled={!selectedRole}
            className="px-12 py-4 text-lg font-semibold"
          >
            Continue to Dashboard
          </Button>
          {selectedRole && (
            <p className="text-white/60 text-sm mt-4">
              Proceeding as {roles.find(r => r.id === selectedRole)?.title}
            </p>
          )}
        </div>
      </div>
    </div>
  );
}