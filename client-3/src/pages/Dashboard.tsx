import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { StaffDashboardHeader } from '@/components/quiz/staff/StaffDashboardHeader';
import { StaffQuizCard } from '@/components/quiz/staff/StaffQuizCard';
import { StaffStatsCard } from '@/components/quiz/staff/StaffStatsCard';
import { StaffQuizUploadForm } from '@/components/quiz/staff/StaffQuizUploadForm';
import { StudentDashboardHeader } from '@/components/quiz/student/StudentDashboardHeader';
import { StudentQuizCard } from '@/components/quiz/student/StudentQuizCard';
import { StudentStatsCard } from '@/components/quiz/student/StudentStatsCard';
import { Button } from '@/components/ui/Button';
import { Input } from '@/components/ui/Input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/Select';
import { useToast } from '@/hooks/use-toast';
import { BookOpen, Clock, Trophy, TrendingUp, Search, Filter, Plus, BarChart3 } from 'lucide-react';


const mockQuizzes = [
  {
    id: '1',
    title: 'Data Structures & Algorithms',
    subject: 'Computer Science',
    instructor: 'Dr. Sarah Johnson',
    duration: 90,
    totalQuestions: 50,
    enrolledStudents: 28,
    maxStudents: 30,
    status: 'active' as const,
    hasAttempted: false,
  },
  {
    id: '2',
    title: 'React Fundamentals',
    subject: 'Web Development',
    instructor: 'Prof. Mike Chen',
    duration: 60,
    totalQuestions: 30,
    enrolledStudents: 15,
    maxStudents: 25,
    status: 'upcoming' as const,
    hasAttempted: false,
  },
  {
    id: '3',
    title: 'Database Management',
    subject: 'Computer Science',
    instructor: 'Dr. Emily Davis',
    duration: 120,
    totalQuestions: 40,
    enrolledStudents: 22,
    maxStudents: 30,
    status: 'completed' as const,
    hasAttempted: true,
    score: 87,
  },
];

export default function Dashboard() {
  const [searchTerm, setSearchTerm] = useState('');
  const [filterStatus, setFilterStatus] = useState('all');
  const [userRole, setUserRole] = useState<'Student' | 'Faculty' | 'Admin'>('Student');
  const [showUploadForm, setShowUploadForm] = useState(false);
  const navigate = useNavigate();
  const { toast } = useToast();

  useEffect(() => {
    const storedRole = localStorage.getItem('userRole') as 'Student' | 'Faculty' | 'Admin';
    if (storedRole) setUserRole(storedRole);
  }, []);

  const filteredQuizzes = mockQuizzes.filter((quiz) => {
    const matchesSearch =
      quiz.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
      quiz.subject.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesFilter = filterStatus === 'all' || quiz.status === filterStatus;
    return matchesSearch && matchesFilter;
  });

  const handleEnroll = (quizId: string) => {
    toast({
      title: 'Enrollment Successful!',
      description: 'You have been enrolled in the quiz.',
    });
  };

  const handleStartQuiz = (quizId: string) => {
    navigate(`/quiz/${quizId}`);
  };

  const handleViewDetails = (quizId: string) => {
    navigate(`/quiz/${quizId}`);
  };

  const handleViewResults = (quizId: string) => {
    navigate(`/results/${quizId}`);
  };

  const handleCreateQuiz = (quiz: { title: string; subject: string; duration: number; questions: any[] }) => {
    // Mock: Add quiz to mockQuizzes (replace with API call in production)
    const newQuiz = {
      id: String(mockQuizzes.length + 1),
      ...quiz,
      instructor: 'Current User',
      totalQuestions: quiz.questions.length,
      enrolledStudents: 0,
      maxStudents: 30,
      status: 'upcoming' as const,
      hasAttempted: false,
    };
    mockQuizzes.push(newQuiz);
    setShowUploadForm(false);
  };

  const getRoleSpecificStats = () => {
    switch (userRole) {
      case 'Faculty':
      case 'Admin':
        return [
          { title: 'Quizzes Created', value: 8, description: 'This semester', icon: BookOpen },
          { title: 'Students Evaluated', value: 156, description: 'Total this month', icon: Clock },
        ];
      default:
        return [
          { title: 'Quizzes Completed', value: 12, description: 'This semester', icon: Trophy },
          { title: 'Average Score', value: '87%', description: 'Last 5 quizzes', icon: TrendingUp },
        ];
    }
  };

  return (
    <div className="min-h-screen bg-gray-100">
      {userRole === 'Student' ? (
        <StudentDashboardHeader userName="Alex Thompson" userAvatar="/placeholder.svg" />
      ) : (
        <StaffDashboardHeader userRole={userRole} userName="Alex Thompson" userAvatar="/placeholder.svg" />
      )}
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="mb-8">
          <h1 className="text-3xl font-bold text-gray-900 mb-2">Welcome back, Alex!</h1>
          <p className="text-gray-600">
            {userRole === 'Student' && 'Ready to continue your learning journey?'}
            {userRole === 'Faculty' && 'Manage your quizzes and monitor student progress.'}
            {userRole === 'Admin' && 'System overview and quiz management.'}
          </p>
        </div>

        {(userRole === 'Faculty' || userRole === 'Admin') && !showUploadForm && (
          <div className="mb-6">
            <Button onClick={() => setShowUploadForm(true)} variant="hero">
              <Plus className="h-4 w-4 mr-2" /> Create Quiz
            </Button>
          </div>
        )}

        {(userRole === 'Faculty' || userRole === 'Admin') && showUploadForm && (
          <StaffQuizUploadForm onSubmit={handleCreateQuiz} className="mb-8" />
        )}

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          {getRoleSpecificStats().map((stat, index) => (
            userRole === 'Student' ? (
              <StudentStatsCard key={index} {...stat} />
            ) : (
              <StaffStatsCard key={index} {...stat} />
            )
          ))}
        </div>

        <div className="flex flex-col sm:flex-row gap-4 mb-6">
          <div className="relative flex-1">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5" />
            <Input
              placeholder="Search quizzes..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-10"
            />
          </div>
          <Select value={filterStatus} onValueChange={setFilterStatus}>
            <SelectTrigger className="w-40">
              <Filter className="h-4 w-4 mr-2" />
              <SelectValue placeholder="Filter by status" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="all">All Quizzes</SelectItem>
              <SelectItem value="active">Active</SelectItem>
              <SelectItem value="upcoming">Upcoming</SelectItem>
              <SelectItem value="completed">Completed</SelectItem>
            </SelectContent>
          </Select>
          {(userRole === 'Faculty' || userRole === 'Admin') && !showUploadForm && (
            <Button variant="outline">
              <BarChart3 className="h-4 w-4 mr-2" /> Analytics
            </Button>
          )}
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredQuizzes.map((quiz) =>
            userRole === 'Student' ? (
              <StudentQuizCard
                key={quiz.id}
                {...quiz}
                onEnroll={() => handleEnroll(quiz.id)}
                onStart={() => handleStartQuiz(quiz.id)}
                onViewResults={() => handleViewResults(quiz.id)}
              />
            ) : (
              <StaffQuizCard
                key={quiz.id}
                {...quiz}
                onViewDetails={() => handleViewDetails(quiz.id)}
                onViewResults={() => handleViewResults(quiz.id)}
              />
            )
          )}
        </div>

        {filteredQuizzes.length === 0 && (
          <div className="text-center py-12">
            <BookOpen className="mx-auto h-12 w-12 text-gray-400 mb-4" />
            <h3 className="text-lg font-medium text-gray-900">No quizzes found</h3>
            <p className="text-gray-600">Try adjusting your search or filter criteria.</p>
          </div>
        )}
      </main>
    </div>
  );
}