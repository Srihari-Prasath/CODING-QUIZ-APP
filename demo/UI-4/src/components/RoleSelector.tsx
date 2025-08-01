import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { User, Users, Shield, Building, GraduationCap } from "lucide-react";
import heroImage from "@/assets/hero-quiz.jpg";

interface RoleSelectorProps {
  onRoleSelect: (role: string) => void;
}

export const RoleSelector = ({ onRoleSelect }: RoleSelectorProps) => {
  const [selectedRole, setSelectedRole] = useState<string>("");

  const roles = [
    {
      id: "student",
      title: "Student",
      description: "Take quizzes, view results, and track progress",
      icon: GraduationCap,
      color: "bg-gradient-primary",
      features: ["Department-specific quizzes", "Real-time results", "Progress tracking", "Resume interrupted tests"]
    },
    {
      id: "faculty",
      title: "Faculty",
      description: "Create quizzes, manage questions, and monitor performance",
      icon: User,
      color: "bg-gradient-success",
      features: ["Quiz creation", "Question management", "Student monitoring", "Performance reports"]
    },
    {
      id: "hod",
      title: "HOD",
      description: "Department oversight and comprehensive reporting",
      icon: Building,
      color: "bg-warning",
      features: ["Department dashboard", "Faculty oversight", "Detailed analytics", "Weekly reports"]
    },
    {
      id: "admin",
      title: "Admin",
      description: "System administration and user management",
      icon: Shield,
      color: "bg-destructive",
      features: ["User management", "System configuration", "Bulk operations", "Security settings"]
    },
    {
      id: "management",
      title: "Management",
      description: "Executive dashboard and institutional insights",
      icon: Users,
      color: "bg-primary",
      features: ["Executive dashboard", "Institution-wide analytics", "Performance insights", "Strategic reports"]
    }
  ];

  const handleRoleSelect = (roleId: string) => {
    setSelectedRole(roleId);
    setTimeout(() => onRoleSelect(roleId), 300);
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-background via-background to-primary/5">
      {/* Hero Section */}
      <div className="relative overflow-hidden">
        <div 
          className="absolute inset-0 bg-cover bg-center opacity-10"
          style={{ backgroundImage: `url(${heroImage})` }}
        />
        <div className="relative px-6 py-16 text-center">
          <div className="mx-auto max-w-4xl">
            <Badge variant="secondary" className="mb-4 animate-fade-in">
              NSCET College Quiz Platform
            </Badge>
            <h1 className="text-4xl md:text-6xl font-bold mb-6 bg-gradient-primary bg-clip-text text-transparent animate-fade-in">
              Digital Assessment Platform
            </h1>
            <p className="text-xl text-muted-foreground mb-8 animate-fade-in delay-150">
              Streamlined, secure, and comprehensive quiz management system for modern education
            </p>
          </div>
        </div>
      </div>

      {/* Role Selection */}
      <div className="px-6 py-12">
        <div className="mx-auto max-w-7xl">
          <div className="text-center mb-12">
            <h2 className="text-3xl font-bold mb-4">Select Your Role</h2>
            <p className="text-muted-foreground">Choose your access level to continue to the platform</p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {roles.map((role, index) => {
              const Icon = role.icon;
              const isSelected = selectedRole === role.id;
              
              return (
                <Card 
                  key={role.id}
                  className={`cursor-pointer transition-all duration-300 hover:shadow-card hover:-translate-y-1 animate-fade-in ${
                    isSelected ? 'ring-2 ring-primary shadow-elegant' : ''
                  }`}
                  style={{ animationDelay: `${index * 100}ms` }}
                  onClick={() => handleRoleSelect(role.id)}
                >
                  <CardHeader>
                    <div className="flex items-center gap-3">
                      <div className={`p-3 rounded-lg ${role.color} text-white`}>
                        <Icon className="h-6 w-6" />
                      </div>
                      <div>
                        <CardTitle className="text-xl">{role.title}</CardTitle>
                        <CardDescription>{role.description}</CardDescription>
                      </div>
                    </div>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-2">
                      {role.features.map((feature, featureIndex) => (
                        <div key={featureIndex} className="flex items-center gap-2 text-sm text-muted-foreground">
                          <div className="h-1.5 w-1.5 bg-primary rounded-full" />
                          {feature}
                        </div>
                      ))}
                    </div>
                    <Button 
                      variant={isSelected ? "default" : "outline"}
                      className="w-full mt-4"
                      onClick={(e) => {
                        e.stopPropagation();
                        handleRoleSelect(role.id);
                      }}
                    >
                      {isSelected ? "Accessing..." : "Select Role"}
                    </Button>
                  </CardContent>
                </Card>
              );
            })}
          </div>
        </div>
      </div>
    </div>
  );
};