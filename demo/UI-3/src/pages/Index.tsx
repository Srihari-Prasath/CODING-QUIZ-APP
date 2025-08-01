import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { RoleSelector } from '@/components/quiz/RoleSelector';
import Dashboard from './Dashboard';

const Index = () => {
  const [selectedRole, setSelectedRole] = useState<string | null>(null);
  const navigate = useNavigate();

  const handleRoleSelect = (roleId: string) => {
    setSelectedRole(roleId);
    // Store role in localStorage for persistence
    localStorage.setItem('userRole', roleId);
    navigate('/dashboard');
  };

  // Check if user has already selected a role
  const storedRole = localStorage.getItem('userRole');
  
  if (storedRole || selectedRole) {
    return <Dashboard />;
  }

  return <RoleSelector onRoleSelect={handleRoleSelect} />;
};

export default Index;
