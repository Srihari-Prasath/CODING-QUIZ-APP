import { useState, type HTMLAttributes } from 'react';

interface SelectProps extends HTMLAttributes<HTMLDivElement> {
  value: string;
  onValueChange: (value: string) => void;
}

interface SelectTriggerProps extends HTMLAttributes<HTMLDivElement> {}
interface SelectContentProps extends HTMLAttributes<HTMLDivElement> {}
interface SelectItemProps extends HTMLAttributes<HTMLDivElement> {
  value: string;
}
interface SelectValueProps extends HTMLAttributes<HTMLSpanElement> {
  placeholder?: string;
}

export function Select({ value, onValueChange, children, className }: SelectProps) {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <div className={`relative ${className}`}>
      <div onClick={() => setIsOpen(!isOpen)}>{children[0]}</div>
      {isOpen && <div className="absolute z-10 mt-1 w-full">{children[1]}</div>}
    </div>
  );
}

export function SelectTrigger({ children, className }: SelectTriggerProps) {
  return (
    <div
      className={`flex items-center justify-between rounded-md border border-gray-300 px-3 py-2 text-sm cursor-pointer ${className}`}
    >
      {children}
    </div>
  );
}

export function SelectContent({ children, className }: SelectContentProps) {
  return (
    <div className={`bg-white rounded-md shadow-lg border border-gray-200 ${className}`}>
      {children}
    </div>
  );
}

export function SelectItem({ value, children, onClick }: SelectItemProps) {
  return (
    <div
      className="px-3 py-2 text-sm hover:bg-gray-100 cursor-pointer"
      onClick={(e) => {
        onClick?.(e);
        (e.currentTarget.parentElement?.parentElement as any)?.onValueChange?.(value);
      }}
    >
      {children}
    </div>
  );
}

export function SelectValue({ placeholder, className }: SelectValueProps) {
  return <span className={className}>{placeholder}</span>;
}