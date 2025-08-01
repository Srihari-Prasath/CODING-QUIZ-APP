import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import Index from './pages/Index.tsx';
import Dashboard from './pages/Dashboard.tsx';
import QuizPage from './pages/QuizPage.tsx';
import ResultsPage from './pages/ResultsPage.tsx';
import './App.css';

const router = createBrowserRouter([
  { path: '/', element: <Index /> },
  { path: '/dashboard', element: <Dashboard /> },
  { path: '/quiz/:quizId', element: <QuizPage /> },
  { path: '/results/:quizId', element: <ResultsPage /> },
]);

function App() {
  return <RouterProvider router={router} />;
}

export default App;