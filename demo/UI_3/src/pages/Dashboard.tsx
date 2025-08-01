import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { DashboardHeader } from "@/components/quiz/DashboardHeader";
import { QuizCard } from "@/components/quiz/QuizCard";
import { StatsCard } from "@/components/quiz/StatsCard";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { useToast } from "@/hooks/use-toast";
import { 
  BookOpen, 
  Clock, 
  Trophy, 
  TrendingUp, 
  Search, 
  Filter,
  Play,
  Calendar,
  Users,
  Plus,
  Settings,
  BarChart3
} from "lucide-react";

const mockQuizzes = [
  {
    id: "1",
    title: "Data Structures & Algorithms",
    subject: "Computer Science",
    instructor: "Dr. Sarah Johnson",
    duration: 90,
    totalQuestions: 50,
    enrolledStudents: 28,
    maxStudents: 30,
    startDate: "2024-01-15T10:00:00Z",
    endDate: "2024-01-15T11:30:00Z",
    status: "active" as const,
    hasAttempted: false
  },
  {
    id: "2", 
    title: "React Fundamentals",
    subject: "Web Development",
    instructor: "Prof. Mike Chen",
    duration: 60,
    totalQuestions: 30,
    enrolledStudents: 15,
    maxStudents: 25,
    startDate: "2024-01-20T14:00:00Z",
    endDate: "2024-01-20T15:00:00Z",
    status: "upcoming" as const,
    hasAttempted: false
  },
  {
    id: "3",
    title: "Database Management",
    subject: "Computer Science", 
    instructor: "Dr. Emily Davis",
    duration: 120,
    totalQuestions: 40,
    enrolledStudents: 22,
    maxStudents: 30,
    startDate: "2024-01-10T09:00:00Z",
    endDate: "2024-01-10T11:00:00Z",
    status: "completed" as const,
    hasAttempted: true,
    score: 87
  }
];

export default function Dashboard() {
  const [searchTerm, setSearchTerm] = useState("");
  const [filterStatus, setFilterStatus] = useState("all");
  const [userRole, setUserRole] = useState<'Student' | 'Faculty' | 'Admin' | 'HOD' | 'Secretary' | 'Vice Principal'>('Student');
  const navigate = useNavigate();
  const { toast } = useToast();

  useEffect(() => {
    // Get user role from localStorage
    const storedRole = localStorage.getItem('userRole') as 'Student' | 'Faculty' | 'Admin' | 'HOD' | 'Secretary' | 'Vice Principal';
    if (storedRole) {
      setUserRole(storedRole);
    }
  }, []);

  const filteredQuizzes = mockQuizzes.filter(quiz => {
    const matchesSearch = quiz.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         quiz.subject.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesFilter = filterStatus === "all" || quiz.status === filterStatus;
    return matchesSearch && matchesFilter;
  });

  const handleEnroll = (quizId: string) => {
    toast({
      title: "Enrollment Successful!",
      description: "You have been enrolled in the quiz.",
    });
  };

  const handleStartQuiz = (quizId: string) => {
    navigate(`/quiz/${quizId}`);
  };

  const handleViewResults = (quizId: string) => {
    navigate(`/results/${quizId}`);
  };

  const handleCreateQuiz = () => {
    toast({
      title: "Create Quiz",
      description: "Quiz creation feature coming soon!",
    });
  };

  const getRoleSpecificStats = () => {
    switch (userRole) {
      case 'Faculty':
        return [
          { title: "Quizzes Created", value: 8, description: "This semester", icon: BookOpen, trend: { value: 12, isPositive: true } },
          { title: "Students Evaluated", value: 156, description: "Total this month", icon: Users, trend: { value: 8, isPositive: true } },
          { title: "Avg. Performance", value: "78%", description: "Class average", icon: TrendingUp, trend: { value: 3, isPositive: true } },
          { title: "Active Quizzes", value: 3, description: "Currently running", icon: Clock }
        ];
      case 'Admin':
        return [
          { title: "Total Quizzes", value: 45, description: "System wide", icon: BookOpen, trend: { value: 15, isPositive: true } },
          { title: "Active Users", value: 234, description: "This week", icon: Users, trend: { value: 12, isPositive: true } },
          { title: "System Uptime", value: "99.8%", description: "This month", icon: TrendingUp },
          { title: "Reports Generated", value: 18, description: "This week", icon: BarChart3, trend: { value: 22, isPositive: true } }
        ];
      default:
        return [
          { title: "Quizzes Completed", value: 12, description: "This semester", icon: Trophy, trend: { value: 15, isPositive: true } },
          { title: "Average Score", value: "87%", description: "Last 5 quizzes", icon: TrendingUp, trend: { value: 5, isPositive: true } },
          { title: "Study Hours", value: 24, description: "This week", icon: Clock, trend: { value: 8, isPositive: true } },
          { title: "Enrolled Quizzes", value: 5, description: "Active enrollments", icon: BookOpen }
        ];
    }
  };

  const getRoleActions = () => {
    switch (userRole) {
      case 'Faculty':
      case 'Admin':
        return (
          <div className="flex gap-2">
            <Button variant="hero" onClick={handleCreateQuiz}>
              <Plus className="mr-2 h-4 w-4" />
              Create Quiz
            </Button>
            <Button variant="outline">
              <Settings className="mr-2 h-4 w-4" />
              Manage
            </Button>
          </div>
        );
      default:
        return null;
    }
  };

  return (
    <div className="min-h-screen bg-background">
      <DashboardHeader 
        userRole={userRole}
        userName="Alex Thompson"
        userAvatar="/placeholder-avatar.jpg"
      />
      
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Welcome Section */}
        <div className="mb-8 flex justify-between items-start">
          <div>
            <h1 className="text-3xl font-bold text-foreground mb-2">
              Welcome back, Alex! 👋
            </h1>
            <p className="text-muted-foreground">
              {userRole === 'Student' && "Ready to continue your learning journey? You have 2 active quizzes waiting."}
              {userRole === 'Faculty' && "Manage your quizzes and monitor student progress."}
              {userRole === 'Admin' && "System overview and comprehensive quiz management."}
              {(userRole === 'HOD' || userRole === 'Secretary' || userRole === 'Vice Principal') && "Department oversight and strategic management."}
            </p>
          </div>
          {getRoleActions()}
        </div>

        {/* Stats Overview */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          {getRoleSpecificStats().map((stat, index) => (
            <StatsCard
              key={index}
              title={stat.title}
              value={stat.value}
              description={stat.description}
              icon={stat.icon}
              trend={stat.trend}
            />
          ))}
        </div>

        {/* Filters and Search */}
        <div className="flex flex-col sm:flex-row gap-4 mb-6">
          <div className="relative flex-1">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground h-4 w-4" />
            <Input
              placeholder="Search quizzes..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-10"
            />
          </div>
          <div className="flex gap-2">
            <Select value={filterStatus} onValueChange={setFilterStatus}>
              <SelectTrigger className="w-40">
                <Filter className="mr-2 h-4 w-4" />
                <SelectValue placeholder="Filter by status" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="all">All Quizzes</SelectItem>
                <SelectItem value="active">Active</SelectItem>
                <SelectItem value="upcoming">Upcoming</SelectItem>
                <SelectItem value="completed">Completed</SelectItem>
              </SelectContent>
            </Select>
            {getRoleActions() && (
              <Button variant="outline">
                <BarChart3 className="mr-2 h-4 w-4" />
                Analytics
              </Button>
            )}
          </div>
        </div>

        {/* Quiz Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredQuizzes.map((quiz) => (
            <QuizCard
              key={quiz.id}
              {...quiz}
              onEnroll={() => handleEnroll(quiz.id)}
              onStart={() => handleStartQuiz(quiz.id)}
              onViewResults={() => handleViewResults(quiz.id)}
            />
          ))}
        </div>

        {filteredQuizzes.length === 0 && (
          <div className="text-center py-12">
            <BookOpen className="mx-auto h-12 w-12 text-muted-foreground mb-4" />
            <h3 className="text-lg font-medium text-foreground mb-2">No quizzes found</h3>
            <p className="text-muted-foreground">
              Try adjusting your search or filter criteria.
            </p>
          </div>
        )}
      </main>
    </div>
  );
}