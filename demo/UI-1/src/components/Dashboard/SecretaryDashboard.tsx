import React from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { useAuth } from '@/contexts/AuthContext';
import { departments } from '@/data/mockData';
import { useNavigate } from 'react-router-dom';
import { Building, Users, TrendingUp, BarChart3, FileText, Shield, Calendar, Database } from 'lucide-react';

const SecretaryDashboard = () => {
  const { user } = useAuth();
  const navigate = useNavigate();

  if (!user) return null;

  const stats = {
    totalStudents: 1200,
    totalStaff: 45,
    totalTests: 64,
    totalDepartments: 8,
    avgPerformance: 78,
    activeUsers: 892
  };

  const departmentStats = departments.map(dept => ({
    ...dept,
    students: Math.floor(Math.random() * 200) + 100,
    averageScore: Math.floor(Math.random() * 30) + 70,
    testsCompleted: Math.floor(Math.random() * 500) + 200
  }));

  return (
    <div className="space-y-6">
      {/* Welcome Section */}
      <div className="bg-gradient-to-r from-accent to-accent-light text-accent-foreground rounded-lg p-6">
        <h1 className="text-3xl font-bold mb-2">Secretary Dashboard</h1>
        <p className="text-accent-foreground/80">
          Administrative Overview • {user.name}
        </p>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Total Students</CardTitle>
            <Users className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.totalStudents}</div>
            <p className="text-xs text-muted-foreground">
              Across all departments
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Faculty Members</CardTitle>
            <Shield className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.totalStaff}</div>
            <p className="text-xs text-muted-foreground">
              Active teaching staff
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Active Tests</CardTitle>
            <Database className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.totalTests}</div>
            <p className="text-xs text-muted-foreground">
              System-wide
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Departments</CardTitle>
            <Building className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.totalDepartments}</div>
            <p className="text-xs text-muted-foreground">
              Engineering streams
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Avg. Performance</CardTitle>
            <TrendingUp className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.avgPerformance}%</div>
            <p className="text-xs text-muted-foreground">
              College-wide average
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Active Users</CardTitle>
            <Users className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.activeUsers}</div>
            <p className="text-xs text-muted-foreground">
              Currently online
            </p>
          </CardContent>
        </Card>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Administrative Actions */}
        <Card>
          <CardHeader>
            <CardTitle>Administrative Actions</CardTitle>
            <CardDescription>System management and reporting tools</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <Button 
              className="w-full justify-start" 
              size="lg"
              onClick={() => navigate('/analytics')}
            >
              <BarChart3 className="w-5 h-5 mr-2" />
              College-wide Analytics
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
            >
              <Shield className="w-5 h-5 mr-2" />
              User Management
            </Button>
            <Button 
              variant="outline" 
              className="w-full justify-start" 
              size="lg"
            >
              <Database className="w-5 h-5 mr-2" />
              System Settings
            </Button>
          </CardContent>
        </Card>

        {/* Department Overview */}
        <Card>
          <CardHeader>
            <CardTitle>Department Overview</CardTitle>
            <CardDescription>Quick stats for all departments</CardDescription>
          </CardHeader>
          <CardContent>
            <div className="space-y-3">
              {departmentStats.slice(0, 4).map((dept) => (
                <div key={dept.id} className="flex items-center justify-between p-3 border rounded-lg">
                  <div className="flex items-center space-x-3">
                    <div className={`w-3 h-3 rounded-full bg-gradient-to-r ${dept.color}`}></div>
                    <div>
                      <p className="font-medium">{dept.code}</p>
                      <p className="text-sm text-muted-foreground">{dept.students} students</p>
                    </div>
                  </div>
                  <div className="text-right">
                    <div className={`text-sm font-bold ${
                      dept.averageScore >= 80 ? 'text-success' :
                      dept.averageScore >= 70 ? 'text-warning' :
                      'text-error'
                    }`}>
                      {dept.averageScore}%
                    </div>
                    <p className="text-xs text-muted-foreground">avg. score</p>
                  </div>
                </div>
              ))}
              <Button 
                variant="outline" 
                className="w-full mt-4"
                onClick={() => navigate('/analytics')}
              >
                View All Departments
              </Button>
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Performance Metrics */}
      <Card>
        <CardHeader>
          <CardTitle>College Performance Metrics</CardTitle>
          <CardDescription>Key performance indicators across all departments</CardDescription>
        </CardHeader>
        <CardContent>
          <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div className="text-center p-4 border rounded-lg">
              <div className="text-3xl font-bold text-success mb-2">85%</div>
              <p className="text-sm text-muted-foreground">Test Completion Rate</p>
              <p className="text-xs text-success mt-1">+7% this semester</p>
            </div>
            <div className="text-center p-4 border rounded-lg">
              <div className="text-3xl font-bold text-primary mb-2">92%</div>
              <p className="text-sm text-muted-foreground">Student Participation</p>
              <p className="text-xs text-primary mt-1">Excellent engagement</p>
            </div>
            <div className="text-center p-4 border rounded-lg">
              <div className="text-3xl font-bold text-secondary mb-2">25</div>
              <p className="text-sm text-muted-foreground">Avg. Test Duration</p>
              <p className="text-xs text-muted-foreground mt-1">Minutes per test</p>
            </div>
            <div className="text-center p-4 border rounded-lg">
              <div className="text-3xl font-bold text-accent mb-2">4.2</div>
              <p className="text-sm text-muted-foreground">System Rating</p>
              <p className="text-xs text-accent mt-1">Out of 5.0</p>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  );
};

export default SecretaryDashboard;