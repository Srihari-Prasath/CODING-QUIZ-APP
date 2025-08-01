import React from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { Progress } from '@/components/ui/progress';
import { useAuth } from '@/contexts/AuthContext';
import { departments, generateMockResults, sampleLeaderboard } from '@/data/mockData';
import { useNavigate } from 'react-router-dom';
import { Trophy, Clock, Target, BookOpen, TrendingUp, Award } from 'lucide-react';

const StudentDashboard = () => {
  const { user } = useAuth();
  const navigate = useNavigate();

  if (!user) return null;

  const userDepartment = departments.find(d => d.id === user.department);
  const mockResults = generateMockResults(user.department);
  const userResults = mockResults.slice(0, 5); // Get user's last 5 results
  const userLeaderboardPosition = sampleLeaderboard.find(entry => entry.userName === user.name);

  const stats = {
    testsCompleted: userResults.length,
    averageScore: userResults.length > 0 ? Math.round(userResults.reduce((sum, result) => sum + result.score, 0) / userResults.length) : 0,
    bestScore: userResults.length > 0 ? Math.max(...userResults.map(r => r.score)) : 0,
    rank: userLeaderboardPosition?.rank || Math.floor(Math.random() * 50) + 1
  };

  return (
    <div className="space-y-6">
      {/* Welcome Section */}
      <div className="bg-gradient-to-r from-primary to-primary-dark text-primary-foreground rounded-lg p-6">
        <h1 className="text-3xl font-bold mb-2">Welcome back, {user.name}!</h1>
        <p className="text-primary-foreground/80">
          {userDepartment?.name} • Student ID: {user.studentId}
        </p>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Tests Completed</CardTitle>
            <BookOpen className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.testsCompleted}</div>
            <p className="text-xs text-muted-foreground">
              +2 from last week
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Average Score</CardTitle>
            <Target className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.averageScore}%</div>
            <p className="text-xs text-muted-foreground">
              +5% from last week
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Best Score</CardTitle>
            <Award className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{stats.bestScore}%</div>
            <p className="text-xs text-muted-foreground">
              Personal best
            </p>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle className="text-sm font-medium">Department Rank</CardTitle>
            <Trophy className="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">#{stats.rank}</div>
            <p className="text-xs text-muted-foreground">
              Out of 150 students
            </p>
          </CardContent>
        </Card>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Quick Actions */}
        <Card>
          <CardHeader>
            <CardTitle>Quick Actions</CardTitle>
            <CardDescription>Start a new test or continue your preparation</CardDescription>
          </CardHeader>
          <CardContent className="space-y-4">
            <Button 
              className="w-full justify-start" 
              size="lg"
              onClick={() => navigate('/test')}
            >
              <BookOpen className="w-5 h-5 mr-2" />
              Start New Test
            </Button>
            <Button 
              variant="outline" 
              className="w-full justify-start" 
              size="lg"
              onClick={() => navigate('/leaderboard')}
            >
              <Trophy className="w-5 h-5 mr-2" />
              View Leaderboard
            </Button>
            <Button 
              variant="outline" 
              className="w-full justify-start" 
              size="lg"
              onClick={() => navigate('/results')}
            >
              <TrendingUp className="w-5 h-5 mr-2" />
              View My Results
            </Button>
          </CardContent>
        </Card>

        {/* Recent Performance */}
        <Card>
          <CardHeader>
            <CardTitle>Recent Performance</CardTitle>
            <CardDescription>Your last 5 test results</CardDescription>
          </CardHeader>
          <CardContent>
            {userResults.length > 0 ? (
              <div className="space-y-4">
                {userResults.map((result, index) => (
                  <div key={result.id} className="flex items-center justify-between p-3 border rounded-lg">
                    <div className="flex items-center space-x-3">
                      <div className="flex-shrink-0">
                        <div className={`w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold ${
                          result.score >= 80 ? 'bg-success text-success-foreground' :
                          result.score >= 60 ? 'bg-warning text-warning-foreground' :
                          'bg-error text-error-foreground'
                        }`}>
                          {result.score}
                        </div>
                      </div>
                      <div>
                        <p className="font-medium">Test #{userResults.length - index}</p>
                        <p className="text-sm text-muted-foreground">
                          {result.timeSpent} minutes • {result.completedAt.toLocaleDateString()}
                        </p>
                      </div>
                    </div>
                    <Badge variant={result.score >= 80 ? 'default' : result.score >= 60 ? 'secondary' : 'destructive'}>
                      {result.score >= 80 ? 'Excellent' : result.score >= 60 ? 'Good' : 'Needs Improvement'}
                    </Badge>
                  </div>
                ))}
              </div>
            ) : (
              <div className="text-center py-8">
                <BookOpen className="w-12 h-12 text-muted-foreground mx-auto mb-4" />
                <p className="text-muted-foreground">No tests completed yet</p>
                <Button className="mt-4" onClick={() => navigate('/test')}>
                  Take Your First Test
                </Button>
              </div>
            )}
          </CardContent>
        </Card>
      </div>

      {/* Department Progress */}
      <Card>
        <CardHeader>
          <CardTitle>Department Progress</CardTitle>
          <CardDescription>Your progress in {userDepartment?.name}</CardDescription>
        </CardHeader>
        <CardContent>
          <div className="space-y-4">
            <div className="flex items-center justify-between">
              <span className="text-sm font-medium">Overall Progress</span>
              <span className="text-sm text-muted-foreground">
                {stats.testsCompleted} / {userDepartment?.totalQuestions || 100} questions
              </span>
            </div>
            <Progress 
              value={(stats.testsCompleted / (userDepartment?.totalQuestions || 100)) * 100} 
              className="h-2"
            />
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
              <div className="text-center p-4 border rounded-lg">
                <div className="text-2xl font-bold text-success">{stats.averageScore}%</div>
                <p className="text-sm text-muted-foreground">Average Score</p>
              </div>
              <div className="text-center p-4 border rounded-lg">
                <div className="text-2xl font-bold text-primary">{stats.testsCompleted}</div>
                <p className="text-sm text-muted-foreground">Tests Taken</p>
              </div>
              <div className="text-center p-4 border rounded-lg">
                <div className="text-2xl font-bold text-secondary">#{stats.rank}</div>
                <p className="text-sm text-muted-foreground">Department Rank</p>
              </div>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  );
};

export default StudentDashboard;