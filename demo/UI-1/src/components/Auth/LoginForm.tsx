import React, { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { useAuth } from '@/contexts/AuthContext';
import { useNavigate } from 'react-router-dom';
import { useToast } from '@/hooks/use-toast';
import { Loader2, Mail, Lock } from 'lucide-react';

interface LoginFormProps {
  role: 'student' | 'staff' | 'secretary';
  onBack: () => void;
}

const LoginForm: React.FC<LoginFormProps> = ({ role, onBack }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const { login } = useAuth();
  const navigate = useNavigate();
  const { toast } = useToast();

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      const success = await login(email, password, role);
      if (success) {
        toast({
          title: "Login successful",
          description: `Welcome back! Redirecting to your dashboard...`
        });
        navigate('/dashboard');
      } else {
        toast({
          title: "Login failed",
          description: "Invalid credentials. Try demo@college.edu with any password.",
          variant: "destructive"
        });
      }
    } catch (error) {
      toast({
        title: "Error",
        description: "An unexpected error occurred. Please try again.",
        variant: "destructive"
      });
    } finally {
      setIsLoading(false);
    }
  };

  const getRoleDetails = (role: string) => {
    switch (role) {
      case 'student':
        return {
          title: 'Student Login',
          description: 'Access your tests and view your progress',
          placeholder: 'student@college.edu'
        };
      case 'staff':
        return {
          title: 'Staff Login',
          description: 'Manage tests and view department analytics',
          placeholder: 'staff@college.edu'
        };
      case 'secretary':
        return {
          title: 'Secretary Login',
          description: 'Administrative access to all departments',
          placeholder: 'secretary@college.edu'
        };
      default:
        return {
          title: 'Login',
          description: 'Sign in to your account',
          placeholder: 'email@college.edu'
        };
    }
  };

  const roleDetails = getRoleDetails(role);

  return (
    <Card className="w-full max-w-md mx-auto">
      <CardHeader className="space-y-1 text-center">
        <CardTitle className="text-2xl font-bold">{roleDetails.title}</CardTitle>
        <CardDescription>{roleDetails.description}</CardDescription>
      </CardHeader>
      <CardContent>
        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="space-y-2">
            <Label htmlFor="email">Email</Label>
            <div className="relative">
              <Mail className="absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground w-4 h-4" />
              <Input
                id="email"
                type="email"
                placeholder={roleDetails.placeholder}
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="pl-10"
                required
              />
            </div>
          </div>
          
          <div className="space-y-2">
            <Label htmlFor="password">Password</Label>
            <div className="relative">
              <Lock className="absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground w-4 h-4" />
              <Input
                id="password"
                type="password"
                placeholder="Enter your password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="pl-10"
                required
              />
            </div>
          </div>

          <div className="space-y-2">
            <Button type="submit" className="w-full" disabled={isLoading}>
              {isLoading ? (
                <>
                  <Loader2 className="mr-2 h-4 w-4 animate-spin" />
                  Signing in...
                </>
              ) : (
                'Sign In'
              )}
            </Button>
            
            <Button type="button" variant="outline" className="w-full" onClick={onBack}>
              Back to Role Selection
            </Button>
          </div>

          <div className="text-center">
            <p className="text-sm text-muted-foreground">
              Demo: Use <code className="bg-muted px-1 rounded">demo@college.edu</code> with any password
            </p>
          </div>
        </form>
      </CardContent>
    </Card>
  );
};

export default LoginForm;