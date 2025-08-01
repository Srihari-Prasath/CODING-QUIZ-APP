import { type ButtonHTMLAttributes } from 'react';

type ButtonVariant = 'default' | 'outline' | 'hero';

interface ButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: ButtonVariant;
  className?: string;
}

export function Button({ variant = 'default', className = '', ...props }: ButtonProps) {
  const baseStyles = 'inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
  const variantStyles = {
    default: 'bg-blue-500 text-white hover:bg-blue-600',
    outline: 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50',
    hero: 'bg-green-500 text-white hover:bg-green-600',
  };

  const styles = `${baseStyles} ${variantStyles[variant]} ${className}`;

  return <button className={styles} {...props} />;
}