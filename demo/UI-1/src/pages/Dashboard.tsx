import React from 'react';
import { useAuth } from '@/contexts/AuthContext';
import StudentDashboard from '@/components/Dashboard/StudentDashboard';
import StaffDashboard from '@/components/Dashboard/StaffDashboard';
import SecretaryDashboard from '@/components/Dashboard/SecretaryDashboard';
import Header from '@/components/Layout/Header';

const Dashboard = () => {
  const { user } = useAuth();

  if (!user) {
    return null;
  }

  const renderDashboard = () => {
    switch (user.role) {
      case 'student':
        return <StudentDashboard />;
      case 'staff':
        return <StaffDashboard />;
      case 'secretary':
        return <SecretaryDashboard />;
      default:
        return <div>Invalid role</div>;
    }
  };

  return (
    <div className="min-h-screen bg-background">
      <Header />
      <main className="container mx-auto px-4 py-8">
        {renderDashboard()}
      </main>
    </div>
  );
};

export default Dashboard;