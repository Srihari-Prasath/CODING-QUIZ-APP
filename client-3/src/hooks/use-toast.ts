import toast from 'react-hot-toast';

export function useToast() {
  return {
    toast: ({ title, description }: { title: string; description: string }) => {
      toast.success(`${title}\n${description}`);
    },
  };
}