import React, { createContext, useContext, useState, useEffect } from 'react';
import { User } from '@/types';
import { sampleUsers } from '@/data/mockData';

interface AuthContextType {
  user: User | null;
  login: (email: string, password: string, role: 'student' | 'staff' | 'secretary') => Promise<boolean>;
  logout: () => void;
  isLoading: boolean;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User | null>(null);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    // Check for stored user session
    const storedUser = localStorage.getItem('mcq-platform-user');
    if (storedUser) {
      setUser(JSON.parse(storedUser));
    }
    setIsLoading(false);
  }, []);

  const login = async (email: string, password: string, role: 'student' | 'staff' | 'secretary'): Promise<boolean> => {
    setIsLoading(true);
    
    // Simulate API call delay
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    // Mock authentication - in real app, this would call an API
    const foundUser = sampleUsers.find(u => u.email === email && u.role === role);
    
    if (foundUser || email === 'demo@college.edu') {
      const userToLogin = foundUser || {
        id: 'demo',
        name: 'Demo User',
        email,
        role,
        department: role === 'secretary' ? 'admin' : 'cse',
        studentId: role === 'student' ? 'DEMO2023001' : undefined
      };
      
      setUser(userToLogin);
      localStorage.setItem('mcq-platform-user', JSON.stringify(userToLogin));
      setIsLoading(false);
      return true;
    }
    
    setIsLoading(false);
    return false;
  };

  const logout = () => {
    setUser(null);
    localStorage.removeItem('mcq-platform-user');
  };

  return (
    <AuthContext.Provider value={{ user, login, logout, isLoading }}>
      {children}
    </AuthContext.Provider>
  );
};