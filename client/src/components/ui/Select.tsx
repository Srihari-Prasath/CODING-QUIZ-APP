import { useState, type HTMLAttributes } from 'react';
import { Children } from 'react';

interface SelectProps extends HTMLAttributes<HTMLDivElement> {
  value: string;
  onValueChange: (value: string) => void;
  children: [React.ReactNode, React.ReactNode]; // Expect exactly two children: SelectTrigger and SelectContent
}

interface SelectTriggerProps extends HTMLAttributes<HTMLDivElement> {}
interface SelectContentProps extends HTMLAttributes<HTMLDivElement> {}
interface SelectItemProps extends HTMLAttributes<HTMLDivElement> {
  value: string;
  onValueChange?: (value: string) => void; // Add onValueChange prop
}
interface SelectValueProps extends HTMLAttributes<HTMLSpanElement> {
  placeholder?: string;
}

export function Select({ value, onValueChange, children, className = '' }: SelectProps) {
  const [isOpen, setIsOpen] = useState(false);

  // Convert children to array and validate
  const childrenArray = Children.toArray(children);
  if (childrenArray.length !== 2) {
    console.error('Select component expects exactly two children: SelectTrigger and SelectContent');
    return null;
  }

  const [trigger, content] = childrenArray;

  return (
    <div className={`relative ${className}`}>
      <div onClick={() => setIsOpen(!isOpen)}>{trigger}</div>
      {isOpen && (
        <div className="absolute z-10 mt-1 w-full">
          {Children.map(content, (child) =>
            // Pass onValueChange to each SelectItem in SelectContent
            Child.isValidElement(child) && child.type === SelectItem
              ? { ...child, props: { ...child.props, onValueChange } }
              : child
          )}
        </div>
      )}
    </div>
  );
}

export function SelectTrigger({ children, className = '' }: SelectTriggerProps) {
  return (
    <div
      className={`flex items-center justify-between rounded-md border border-gray-300 px-3 py-2 text-sm cursor-pointer ${className}`}
    >
      {children}
    </div>
  );
}

export function SelectContent({ children, className = '' }: SelectContentProps) {
  return (
    <div className={`bg-white rounded-md shadow-lg border border-gray-200 ${className}`}>
      {children}
    </div>
  );
}

export function SelectItem({ value, children, onClick, onValueChange }: SelectItemProps) {
  return (
    <div
      className="px-3 py-2 text-sm hover:bg-gray-100 cursor-pointer"
      onClick={(e) => {
        onClick?.(e);
        onValueChange?.(value); // Use the passed onValueChange prop
      }}
    >
      {children}
    </div>
  );
}

export function SelectValue({ placeholder, className = '' }: SelectValueProps) {
  return <span className={className}>{placeholder}</span>;
}