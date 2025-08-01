import { Link } from 'react-router-dom';

function Index() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <div className="bg-white p-8 rounded-lg shadow-md">
        <h1 className="text-3xl font-bold mb-6 text-center">Quiz App</h1>
        <Link to="/dashboard" className="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
          Go to Dashboard
        </Link>
      </div>
    </div>
  );
}

export default Index;