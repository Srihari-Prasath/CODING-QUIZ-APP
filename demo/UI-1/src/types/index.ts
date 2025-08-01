export interface User {
  id: string;
  name: string;
  email: string;
  role: 'student' | 'staff' | 'secretary';
  department: string;
  studentId?: string;
  avatar?: string;
}

export interface Department {
  id: string;
  name: string;
  code: string;
  color: string;
  icon: string;
  totalQuestions: number;
}

export interface Question {
  id: string;
  question: string;
  options: string[];
  correctAnswer: number;
  difficulty: 'easy' | 'medium' | 'hard';
  department: string;
  topic: string;
}

export interface TestResult {
  id: string;
  userId: string;
  userName: string;
  department: string;
  score: number;
  totalQuestions: number;
  timeSpent: number;
  completedAt: Date;
  answers: number[];
}

export interface LeaderboardEntry {
  id: string;
  userId: string;
  userName: string;
  department: string;
  totalScore: number;
  testsCompleted: number;
  averageScore: number;
  rank: number;
  avatar?: string;
}

export interface TestSession {
  id: string;
  userId: string;
  department: string;
  questions: Question[];
  currentQuestionIndex: number;
  answers: number[];
  startTime: Date;
  timeLimit: number; // in minutes
  isCompleted: boolean;
}