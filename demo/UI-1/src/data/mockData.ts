import { Department, Question, TestResult, LeaderboardEntry, User } from '@/types';

export const departments: Department[] = [
  {
    id: 'cse',
    name: 'Computer Science Engineering',
    code: 'CSE',
    color: 'from-blue-500 to-blue-700',
    icon: 'Monitor',
    totalQuestions: 150
  },
  {
    id: 'ece',
    name: 'Electronics & Communication',
    code: 'ECE',
    color: 'from-purple-500 to-purple-700',
    icon: 'Cpu',
    totalQuestions: 120
  },
  {
    id: 'mech',
    name: 'Mechanical Engineering',
    code: 'MECH',
    color: 'from-orange-500 to-orange-700',
    icon: 'Settings',
    totalQuestions: 130
  },
  {
    id: 'civil',
    name: 'Civil Engineering',
    code: 'CIVIL',
    color: 'from-yellow-500 to-yellow-700',
    icon: 'Building',
    totalQuestions: 140
  },
  {
    id: 'eee',
    name: 'Electrical Engineering',
    code: 'EEE',
    color: 'from-green-500 to-green-700',
    icon: 'Zap',
    totalQuestions: 125
  },
  {
    id: 'chemical',
    name: 'Chemical Engineering',
    code: 'CHE',
    color: 'from-red-500 to-red-700',
    icon: 'Beaker',
    totalQuestions: 110
  },
  {
    id: 'bio',
    name: 'Biotechnology',
    code: 'BIO',
    color: 'from-teal-500 to-teal-700',
    icon: 'Microscope',
    totalQuestions: 100
  },
  {
    id: 'it',
    name: 'Information Technology',
    code: 'IT',
    color: 'from-indigo-500 to-indigo-700',
    icon: 'Server',
    totalQuestions: 135
  }
];

export const sampleQuestions: Question[] = [
  {
    id: '1',
    question: 'What is the time complexity of binary search?',
    options: ['O(n)', 'O(log n)', 'O(n²)', 'O(1)'],
    correctAnswer: 1,
    difficulty: 'medium',
    department: 'cse',
    topic: 'Data Structures'
  },
  {
    id: '2',
    question: 'Which sorting algorithm has the best average case time complexity?',
    options: ['Bubble Sort', 'Quick Sort', 'Insertion Sort', 'Selection Sort'],
    correctAnswer: 1,
    difficulty: 'medium',
    department: 'cse',
    topic: 'Algorithms'
  },
  {
    id: '3',
    question: 'What is the basic unit of a digital circuit?',
    options: ['Transistor', 'Gate', 'Flip-flop', 'Register'],
    correctAnswer: 1,
    difficulty: 'easy',
    department: 'ece',
    topic: 'Digital Electronics'
  }
];

export const sampleUsers: User[] = [
  {
    id: '1',
    name: 'John Doe',
    email: 'john.doe@college.edu',
    role: 'student',
    department: 'cse',
    studentId: 'CSE2023001'
  },
  {
    id: '2',
    name: 'Jane Smith',
    email: 'jane.smith@college.edu',
    role: 'student',
    department: 'ece',
    studentId: 'ECE2023002'
  },
  {
    id: '3',
    name: 'Dr. Robert Johnson',
    email: 'robert.johnson@college.edu',
    role: 'staff',
    department: 'cse'
  }
];

export const sampleLeaderboard: LeaderboardEntry[] = [
  {
    id: '1',
    userId: '1',
    userName: 'Alice Johnson',
    department: 'cse',
    totalScore: 950,
    testsCompleted: 12,
    averageScore: 79.2,
    rank: 1
  },
  {
    id: '2',
    userId: '2',
    userName: 'Bob Smith',
    department: 'cse',
    totalScore: 920,
    testsCompleted: 11,
    averageScore: 83.6,
    rank: 2
  },
  {
    id: '3',
    userId: '3',
    userName: 'Carol Davis',
    department: 'cse',
    totalScore: 890,
    testsCompleted: 10,
    averageScore: 89.0,
    rank: 3
  },
  {
    id: '4',
    userId: '4',
    userName: 'David Wilson',
    department: 'cse',
    totalScore: 875,
    testsCompleted: 9,
    averageScore: 97.2,
    rank: 4
  },
  {
    id: '5',
    userId: '5',
    userName: 'Eva Brown',
    department: 'cse',
    totalScore: 860,
    testsCompleted: 8,
    averageScore: 107.5,
    rank: 5
  }
];

export const generateMockResults = (department: string): TestResult[] => {
  const results: TestResult[] = [];
  const students = ['Alice', 'Bob', 'Carol', 'David', 'Eva', 'Frank', 'Grace', 'Henry'];
  
  for (let i = 0; i < 20; i++) {
    results.push({
      id: `result-${i}`,
      userId: `user-${i}`,
      userName: students[i % students.length] + ` ${Math.floor(i / students.length) + 1}`,
      department,
      score: Math.floor(Math.random() * 50) + 50, // 50-100 score
      totalQuestions: 20,
      timeSpent: Math.floor(Math.random() * 30) + 10, // 10-40 minutes
      completedAt: new Date(Date.now() - Math.random() * 7 * 24 * 60 * 60 * 1000), // within last 7 days
      answers: Array(20).fill(0).map(() => Math.floor(Math.random() * 4))
    });
  }
  
  return results.sort((a, b) => b.score - a.score);
};