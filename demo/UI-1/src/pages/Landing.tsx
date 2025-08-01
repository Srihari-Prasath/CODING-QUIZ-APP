import React, { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { GraduationCap, Users, Shield, BookOpen, Trophy, BarChart3 } from 'lucide-react';
import LoginForm from '@/components/Auth/LoginForm';

type UserRole = 'student' | 'staff' | 'secretary' | null;

const Landing = () => {
  const [selectedRole, setSelectedRole] = useState<UserRole>(null);

  if (selectedRole) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-primary-light via-background to-secondary-light flex items-center justify-center p-4">
        <LoginForm role={selectedRole} onBack={() => setSelectedRole(null)} />
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-primary-light via-background to-secondary-light">
      <div className="container mx-auto px-4 py-8">
        {/* Hero Section */}
        <div className="text-center mb-12">
          <h1 className="text-4xl md:text-6xl font-bold text-primary mb-4">
            EduTest Platform
          </h1>
          <p className="text-xl md:text-2xl text-muted-foreground mb-8 max-w-3xl mx-auto">
            Comprehensive MCQ testing platform for college students across all departments
          </p>
          
          {/* Features Grid */}
          <div className="grid md:grid-cols-3 gap-6 mb-12 max-w-4xl mx-auto">
            <div className="flex flex-col items-center p-4">
              <BookOpen className="w-12 h-12 text-primary mb-2" />
              <h3 className="font-semibold text-lg">8 Departments</h3>
              <p className="text-sm text-muted-foreground text-center">
                Specialized MCQs for CSE, ECE, Mechanical, Civil, EEE, Chemical, Bio, and IT
              </p>
            </div>
            <div className="flex flex-col items-center p-4">
              <Trophy className="w-12 h-12 text-secondary mb-2" />
              <h3 className="font-semibold text-lg">Leaderboards</h3>
              <p className="text-sm text-muted-foreground text-center">
                Track your progress and compete with peers in your department
              </p>
            </div>
            <div className="flex flex-col items-center p-4">
              <BarChart3 className="w-12 h-12 text-accent mb-2" />
              <h3 className="font-semibold text-lg">Analytics</h3>
              <p className="text-sm text-muted-foreground text-center">
                Detailed performance analytics and department-wise reports
              </p>
            </div>
          </div>
        </div>

        {/* Role Selection */}
        <div className="max-w-4xl mx-auto">
          <h2 className="text-3xl font-bold text-center mb-8">Choose Your Role</h2>
          <div className="grid md:grid-cols-3 gap-6">
            <Card className="cursor-pointer hover:shadow-lg transition-shadow border-2 hover:border-primary" onClick={() => setSelectedRole('student')}>
              <CardHeader className="text-center">
                <GraduationCap className="w-16 h-16 text-primary mx-auto mb-4" />
                <CardTitle className="text-2xl">Student</CardTitle>
                <CardDescription>
                  Take tests, view results, and track your progress
                </CardDescription>
              </CardHeader>
              <CardContent>
                <Button className="w-full" variant="outline">
                  Login as Student
                </Button>
                <div className="mt-4 text-sm text-muted-foreground">
                  <ul className="space-y-1">
                    <li>• Access department-specific MCQs</li>
                    <li>• View personal dashboard</li>
                    <li>• Track performance history</li>
                    <li>• See department leaderboard</li>
                  </ul>
                </div>
              </CardContent>
            </Card>

            <Card className="cursor-pointer hover:shadow-lg transition-shadow border-2 hover:border-secondary" onClick={() => setSelectedRole('staff')}>
              <CardHeader className="text-center">
                <Users className="w-16 h-16 text-secondary mx-auto mb-4" />
                <CardTitle className="text-2xl">Staff</CardTitle>
                <CardDescription>
                  Manage tests and monitor student performance
                </CardDescription>
              </CardHeader>
              <CardContent>
                <Button className="w-full" variant="outline">
                  Login as Staff
                </Button>
                <div className="mt-4 text-sm text-muted-foreground">
                  <ul className="space-y-1">
                    <li>• View department analytics</li>
                    <li>• Monitor student progress</li>
                    <li>• Generate performance reports</li>
                    <li>• Access test management tools</li>
                  </ul>
                </div>
              </CardContent>
            </Card>

            <Card className="cursor-pointer hover:shadow-lg transition-shadow border-2 hover:border-accent" onClick={() => setSelectedRole('secretary')}>
              <CardHeader className="text-center">
                <Shield className="w-16 h-16 text-accent mx-auto mb-4" />
                <CardTitle className="text-2xl">Secretary</CardTitle>
                <CardDescription>
                  Administrative access to all departments
                </CardDescription>
              </CardHeader>
              <CardContent>
                <Button className="w-full" variant="outline">
                  Login as Secretary
                </Button>
                <div className="mt-4 text-sm text-muted-foreground">
                  <ul className="space-y-1">
                    <li>• Cross-department analytics</li>
                    <li>• Comprehensive reporting</li>
                    <li>• System administration</li>
                    <li>• All department access</li>
                  </ul>
                </div>
              </CardContent>
            </Card>
          </div>
        </div>

        {/* Demo Information */}
        <div className="text-center mt-12">
          <Card className="max-w-2xl mx-auto bg-muted/50">
            <CardContent className="pt-6">
              <h3 className="font-semibold mb-2">Demo Access</h3>
              <p className="text-sm text-muted-foreground">
                Use <code className="bg-background px-2 py-1 rounded">demo@college.edu</code> with any password to explore the platform
              </p>
            </CardContent>
          </Card>
        </div>
      </div>
    </div>
  );
};

export default Landing;