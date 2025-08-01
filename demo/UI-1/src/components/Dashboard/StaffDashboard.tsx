import React from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { useAuth } from '@/contexts/AuthContext';
import { departments, generateMockResults } from '@/data/mockData';
import { useNavigate } from 'react-router-dom';
import { Users, TrendingUp, BarChart3, FileText, BookOpen, Trophy, Calendar, Settings } from 'lucide-react';

const StaffDashboard = () => {
  const { user } = useAuth();
  const navigate = useNavigate();

  if (!user) return null;

  const userDepartment = departments.find(d => d.id === user.department);
  const departmentResults = generateMockResults(user.department);
  
  const stats = {
    totalStudents: 150,
    activeTests: 8,
    averageScore: Math.round(departmentResults.reduce((sum, result) => sum + result.score, 0) / departmentResults.length),
    testsCompleted: departmentResults.length
  };

  const recentActivity = [
    { student: 'Alice Johnson', action: 'Completed Test #5', score: 92, time: '2 hours ago' },
    { student: 'Bob Smith', action: 'Started Test #3', score: null, time: '3 hours ago' },
    { student: 'Carol Davis', action: 'Completed Test #7', score: 88, time: '5 hours ago' },
    { student: 'David Wilson', action: 'Completed Test #2', score: 76, time: '6 hours ago' },
  ];

  return (
    <div className="space-y-6">
      {/* Welcome Section */}
      <div className="bg-gradient-to-r from-secondary to-secondary-dark text-secondary-foreground rounded-lg p-6">
        <h1 className="text-3xl font-bold mb-2">Staff Dashboard</h1>
        <p className="text-secondary-foreground/80">
          {userDepartment?.name} • Dr. {user.name}
        </p>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Total Students</CardTitle>
            <Users className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.totalStudents}</div>
            <p className="text-xs text-muted-foreground">
              +12 from last semester
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Active Tests</CardTitle>
            <BookOpen className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.activeTests}</div>
            <p className="text-xs text-muted-foreground">
              2 new this week
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Avg. Score</CardTitle>
            <TrendingUp className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.averageScore}%</div>
            <p className="text-xs text-muted-foreground">
              +3% from last month
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Tests Completed</CardTitle>
            <Trophy className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.testsCompleted}</div>
            <p className="text-xs text-muted-foreground">
              This month
            </p>
          </CardContent>
        </Card>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Quick Actions */}
        <Card>
          <CardHeader>
            <CardTitle>Staff Actions</CardTitle>
            <CardDescription>Manage tests and monitor student progress</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <Button 
              className="w-full justify-start" 
              size="lg"
              onClick={() => navigate('/analytics')}
            >
              <BarChart3 className="w-5 h-5 mr-2" />
              View Analytics
            </Button>
            <Button 
              variant="outline" 
              className="w-full justify-start" 
              size="lg"
              onClick={() => navigate('/reports')}
            >
              <FileText className="w-5 h-5 mr-2" />
              Generate Reports
            </Button>
            <Button 
              variant="outline" 
              className="w-full justify-start" 
              size="lg"
              onClick={() => navigate('/leaderboard')}
            >
              <Trophy className="w-5 h-5 mr-2" />
              Department Leaderboard
            </Button>
            <Button 
              variant="outline" 
              className="w-full justify-start" 
              size="lg"
            >
              <Settings className="w-5 h-5 mr-2" />
              Test Management
            </Button>
          </CardContent>
        </Card>

        {/* Recent Activity */}
        <Card>
          <CardHeader>
            <CardTitle>Recent Activity</CardTitle>
            <CardDescription>Latest student activity in your department</CardDescription>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {recentActivity.map((activity, index) => (
                <div key={index} className="flex items-center justify-between p-3 border rounded-lg">
                  <div className="flex items-center space-x-3">
                    <div className="flex-shrink-0">
                      <div className="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                        <Users className="w-4 h-4 text-primary" />
                      </div>
                    </div>
                    <div>
                      <p className="font-medium">{activity.student}</p>
                      <p className="text-sm text-muted-foreground">{activity.action}</p>
                    </div>
                  </div>
                  <div className="text-right">
                    {activity.score && (
                      <div className={`text-sm font-bold ${
                        activity.score >= 80 ? 'text-success' :
                        activity.score >= 60 ? 'text-warning' :
                        'text-error'
                      }`}>
                        {activity.score}%
                      </div>
                    )}
                    <p className="text-xs text-muted-foreground">{activity.time}</p>
                  </div>
                </div>
              ))}
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Department Performance Overview */}
      <Card>
        <CardHeader>
          <CardTitle>Department Performance Overview</CardTitle>
          <CardDescription>{userDepartment?.name} statistics and trends</CardDescription>
        </CardHeader>
        <CardContent>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div className="text-center p-4 border rounded-lg">
              <div className="text-3xl font-bold text-success mb-2">{stats.averageScore}%</div>
              <p className="text-sm text-muted-foreground">Department Average</p>
              <p className="text-xs text-success mt-1">+3% vs last month</p>
            </div>
            <div className="text-center p-4 border rounded-lg">
              <div className="text-3xl font-bold text-primary mb-2">89%</div>
              <p className="text-sm text-muted-foreground">Completion Rate</p>
              <p className="text-xs text-primary mt-1">+5% vs last month</p>
            </div>
            <div className="text-center p-4 border rounded-lg">
              <div className="text-3xl font-bold text-secondary mb-2">23</div>
              <p className="text-sm text-muted-foreground">Avg. Minutes/Test</p>
              <p className="text-xs text-muted-foreground mt-1">Optimal timing</p>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  );
};

export default StaffDashboard;