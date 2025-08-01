import { useState } from "react";
import { RoleSelector } from "@/components/RoleSelector";
import { Dashboard } from "@/components/Dashboard";
import { QuizInterface } from "@/components/QuizInterface";

const Index = () => {
  const [currentView, setCurrentView] = useState<"role-selector" | "dashboard" | "quiz">("role-selector");
  const [selectedRole, setSelectedRole] = useState<string>("");

  const handleRoleSelect = (role: string) => {
    setSelectedRole(role);
    setCurrentView("dashboard");
  };

  const handleStartQuiz = () => {
    setCurrentView("quiz");
  };

  const handleBackToDashboard = () => {
    setCurrentView("dashboard");
  };

  const handleBackToRoleSelector = () => {
    setCurrentView("role-selector");
    setSelectedRole("");
  };

  const handleQuizComplete = () => {
    setCurrentView("dashboard");
  };

  return (
    <div>
      {currentView === "role-selector" && (
        <RoleSelector onRoleSelect={handleRoleSelect} />
      )}
      
      {currentView === "dashboard" && (
        <Dashboard 
          role={selectedRole} 
          onBack={handleBackToRoleSelector}
          onStartQuiz={handleStartQuiz}
        />
      )}
      
      {currentView === "quiz" && (
        <QuizInterface 
          onBack={handleBackToDashboard}
          onComplete={handleQuizComplete}
        />
      )}
    </div>
  );
};

export default Index;
