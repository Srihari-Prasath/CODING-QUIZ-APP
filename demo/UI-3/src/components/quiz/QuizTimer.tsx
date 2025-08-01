import { useState, useEffect } from "react";
import { Clock, AlertTriangle } from "lucide-react";

interface QuizTimerProps {
  duration: number; // in minutes
  onTimeUp: () => void;
  className?: string;
}

export function QuizTimer({ duration, onTimeUp, className = "" }: QuizTimerProps) {
  const [timeLeft, setTimeLeft] = useState(duration * 60); // Convert to seconds
  const [isWarning, setIsWarning] = useState(false);

  useEffect(() => {
    if (timeLeft <= 0) {
      onTimeUp();
      return;
    }

    // Warning when 5 minutes left
    if (timeLeft <= 300 && !isWarning) {
      setIsWarning(true);
    }

    const timer = setInterval(() => {
      setTimeLeft((prev) => prev - 1);
    }, 1000);

    return () => clearInterval(timer);
  }, [timeLeft, onTimeUp, isWarning]);

  const formatTime = (seconds: number) => {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;

    if (hours > 0) {
      return `${hours.toString().padStart(2, '0')}:${minutes
        .toString()
        .padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
    return `${minutes.toString().padStart(2, '0')}:${secs
      .toString()
      .padStart(2, '0')}`;
  };

  const getProgressPercentage = () => {
    return ((duration * 60 - timeLeft) / (duration * 60)) * 100;
  };

  return (
    <div className={`${className}`}>
      <div
        className={`quiz-timer ${
          isWarning ? 'animate-pulse-glow' : ''
        } flex items-center gap-2`}
      >
        {isWarning ? (
          <AlertTriangle className="h-5 w-5" />
        ) : (
          <Clock className="h-5 w-5" />
        )}
        <span className="text-lg font-mono font-bold">
          {formatTime(timeLeft)}
        </span>
      </div>
      
      {/* Progress bar */}
      <div className="mt-2 w-full bg-muted rounded-full h-2">
        <div
          className={`h-2 rounded-full transition-all duration-1000 ${
            isWarning ? 'bg-destructive' : 'bg-primary'
          }`}
          style={{ width: `${getProgressPercentage()}%` }}
        />
      </div>
      
      {isWarning && (
        <p className="text-xs text-destructive mt-1 font-medium">
          ⚠️ Less than 5 minutes remaining!
        </p>
      )}
    </div>
  );
}