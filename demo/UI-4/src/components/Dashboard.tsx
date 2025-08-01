import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Progress } from "@/components/ui/progress";
import { 
  Clock, 
  Trophy, 
  Target, 
  Users, 
  BookOpen, 
  BarChart3, 
  Calendar,
  Play,
  CheckCircle,
  XCircle,
  Pause,
  ArrowLeft
} from "lucide-react";

interface DashboardProps {
  role: string;
  onBack: () => void;
  onStartQuiz: () => void;
}

export const Dashboard = ({ role, onBack, onStartQuiz }: DashboardProps) => {
  const [selectedDepartment] = useState("Computer Science");

  const getDashboardData = () => {
    switch (role) {
      case "student":
        return {
          title: "Student Dashboard",
          subtitle: "Track your quiz performance and upcoming assessments",
          cards: [
            {
              title: "Quizzes Completed",
              value: "24",
              description: "This semester",
              icon: CheckCircle,
              color: "text-accent"
            },
            {
              title: "Average Score",
              value: "87%",
              description: "+5% from last month",
              icon: Target,
              color: "text-primary"
            },
            {
              title: "Department Rank",
              value: "#12",
              description: "Out of 156 students",
              icon: Trophy,
              color: "text-warning"
            },
            {
              title: "Time Spent",
              value: "45h",
              description: "Total quiz time",
              icon: Clock,
              color: "text-muted-foreground"
            }
          ]
        };
      case "faculty":
        return {
          title: "Faculty Dashboard",
          subtitle: "Manage quizzes and monitor student performance",
          cards: [
            {
              title: "Active Quizzes",
              value: "8",
              description: "Currently running",
              icon: Play,
              color: "text-accent"
            },
            {
              title: "Students Enrolled",
              value: "156",
              description: "Across all courses",
              icon: Users,
              color: "text-primary"
            },
            {
              title: "Avg. Performance",
              value: "82%",
              description: "Class average",
              icon: BarChart3,
              color: "text-warning"
            },
            {
              title: "Questions Created",
              value: "245",
              description: "Question bank",
              icon: BookOpen,
              color: "text-muted-foreground"
            }
          ]
        };
      default:
        return {
          title: `${role.charAt(0).toUpperCase() + role.slice(1)} Dashboard`,
          subtitle: "Comprehensive platform overview and analytics",
          cards: [
            {
              title: "Total Users",
              value: "1,247",
              description: "Active platform users",
              icon: Users,
              color: "text-primary"
            },
            {
              title: "Quizzes Conducted",
              value: "432",
              description: "This month",
              icon: BookOpen,
              color: "text-accent"
            },
            {
              title: "Success Rate",
              value: "94%",
              description: "Platform reliability",
              icon: CheckCircle,
              color: "text-warning"
            },
            {
              title: "Departments",
              value: "12",
              description: "Active departments",
              icon: Calendar,
              color: "text-muted-foreground"
            }
          ]
        };
    }
  };

  const data = getDashboardData();
  
  const recentQuizzes = [
    { name: "Data Structures Quiz", department: "CS", status: "completed", score: 95 },
    { name: "Database Systems", department: "CS", status: "pending", score: null },
    { name: "Operating Systems", department: "CS", status: "completed", score: 88 },
    { name: "Computer Networks", department: "CS", status: "in-progress", score: null },
  ];

  return (
    <div className="min-h-screen bg-background">
      {/* Header */}
      <div className="border-b border-border bg-card">
        <div className="px-6 py-4">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-4">
              <Button variant="ghost" size="icon" onClick={onBack}>
                <ArrowLeft className="h-4 w-4" />
              </Button>
              <div>
                <h1 className="text-2xl font-bold">{data.title}</h1>
                <p className="text-muted-foreground">{data.subtitle}</p>
              </div>
            </div>
            <div className="flex items-center gap-3">
              <Badge variant="secondary">{selectedDepartment}</Badge>
              {role === "student" && (
                <Button variant="hero" onClick={onStartQuiz}>
                  <Play className="h-4 w-4" />
                  Take Quiz
                </Button>
              )}
              {role === "faculty" && (
                <Button variant="success">
                  <BookOpen className="h-4 w-4" />
                  Create Quiz
                </Button>
              )}
            </div>
          </div>
        </div>
      </div>

      {/* Main Content */}
      <div className="px-6 py-8">
        <div className="mx-auto max-w-7xl space-y-8">
          {/* Stats Cards */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {data.cards.map((card, index) => {
              const Icon = card.icon;
              return (
                <Card key={index} className="animate-fade-in hover:shadow-card transition-all duration-200" style={{ animationDelay: `${index * 100}ms` }}>
                  <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                    <CardTitle className="text-sm font-medium">{card.title}</CardTitle>
                    <Icon className={`h-4 w-4 ${card.color}`} />
                  </CardHeader>
                  <CardContent>
                    <div className="text-2xl font-bold">{card.value}</div>
                    <p className="text-xs text-muted-foreground">{card.description}</p>
                  </CardContent>
                </Card>
              );
            })}
          </div>

          {/* Recent Activity */}
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <Card className="animate-fade-in" style={{ animationDelay: "400ms" }}>
              <CardHeader>
                <CardTitle>Recent Quizzes</CardTitle>
                <CardDescription>Your latest quiz activities</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {recentQuizzes.map((quiz, index) => (
                    <div key={index} className="flex items-center justify-between p-3 rounded-lg bg-secondary/50">
                      <div className="flex items-center gap-3">
                        <div className={`p-2 rounded-lg ${
                          quiz.status === 'completed' ? 'bg-accent text-accent-foreground' :
                          quiz.status === 'in-progress' ? 'bg-warning text-warning-foreground' :
                          'bg-muted text-muted-foreground'
                        }`}>
                          {quiz.status === 'completed' ? <CheckCircle className="h-4 w-4" /> :
                           quiz.status === 'in-progress' ? <Pause className="h-4 w-4" /> :
                           <XCircle className="h-4 w-4" />}
                        </div>
                        <div>
                          <p className="font-medium">{quiz.name}</p>
                          <p className="text-sm text-muted-foreground">{quiz.department}</p>
                        </div>
                      </div>
                      {quiz.score && (
                        <Badge variant="secondary">{quiz.score}%</Badge>
                      )}
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>

            <Card className="animate-fade-in" style={{ animationDelay: "500ms" }}>
              <CardHeader>
                <CardTitle>Performance Overview</CardTitle>
                <CardDescription>Monthly progress tracking</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  <div>
                    <div className="flex justify-between text-sm mb-2">
                      <span>Quiz Completion Rate</span>
                      <span>87%</span>
                    </div>
                    <Progress value={87} className="h-2" />
                  </div>
                  <div>
                    <div className="flex justify-between text-sm mb-2">
                      <span>Average Score</span>
                      <span>84%</span>
                    </div>
                    <Progress value={84} className="h-2" />
                  </div>
                  <div>
                    <div className="flex justify-between text-sm mb-2">
                      <span>Time Management</span>
                      <span>92%</span>
                    </div>
                    <Progress value={92} className="h-2" />
                  </div>
                  <div>
                    <div className="flex justify-between text-sm mb-2">
                      <span>Department Ranking</span>
                      <span>78%</span>
                    </div>
                    <Progress value={78} className="h-2" />
                  </div>
                </div>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </div>
  );
};