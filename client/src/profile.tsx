import { useState } from 'react';

interface ProblemStats {
  total: number;
  solved: number;
  easy: { total: number; solved: number };
  medium: { total: number; solved: number };
  hard: { total: number; solved: number };
}

interface UserSubmission {
  id: number;
  problemName: string;
  difficulty: 'Easy' | 'Medium' | 'Hard';
  status: 'Accepted' | 'Wrong Answer' | 'Time Limit Exceeded' | 'Runtime Error';
  language: string;
  runtime: string;
  memory: string;
  date: string;
}

interface Badge {
  id: number;
  name: string;
  description: string;
  icon: string;
  dateEarned: string;
}

const Profile = () => {
  // Mock data - in a real app, this would come from an API
  const [user] = useState({
    username: 'CodeMaster42',
    joinDate: 'January 15, 2023',
    rank: 12345,
    streak: 7, // days
    contributions: 42,
  });

  const [problemStats] = useState<ProblemStats>({
    total: 2500,
    solved: 342,
    easy: { total: 800, solved: 210 },
    medium: { total: 1200, solved: 115 },
    hard: { total: 500, solved: 17 },
  });

  const [recentSubmissions] = useState<UserSubmission[]>([
    {
      id: 1,
      problemName: 'Two Sum',
      difficulty: 'Easy',
      status: 'Accepted',
      language: 'TypeScript',
      runtime: '76 ms',
      memory: '44.8 MB',
      date: '2023-10-15',
    },
    {
      id: 2,
      problemName: 'Add Two Numbers',
      difficulty: 'Medium',
      status: 'Accepted',
      language: 'TypeScript',
      runtime: '112 ms',
      memory: '47.2 MB',
      date: '2023-10-14',
    },
    {
      id: 3,
      problemName: 'Median of Two Sorted Arrays',
      difficulty: 'Hard',
      status: 'Wrong Answer',
      language: 'TypeScript',
      runtime: 'N/A',
      memory: 'N/A',
      date: '2023-10-13',
    },
    {
      id: 4,
      problemName: 'Longest Palindromic Substring',
      difficulty: 'Medium',
      status: 'Time Limit Exceeded',
      language: 'TypeScript',
      runtime: 'N/A',
      memory: 'N/A',
      date: '2023-10-12',
    },
    {
      id: 5,
      problemName: 'Valid Parentheses',
      difficulty: 'Easy',
      status: 'Accepted',
      language: 'TypeScript',
      runtime: '68 ms',
      memory: '42.3 MB',
      date: '2023-10-11',
    },
  ]);

  const [badges] = useState<Badge[]>([
    {
      id: 1,
      name: '7-Day Streak',
      description: 'Solved at least one problem every day for 7 consecutive days',
      icon: '🔥',
      dateEarned: '2023-10-15',
    },
    {
      id: 2,
      name: 'Algorithm Master',
      description: 'Solved 100 algorithm problems',
      icon: '🧠',
      dateEarned: '2023-09-20',
    },
    {
      id: 3,
      name: 'Early Bird',
      description: 'Joined during the beta phase',
      icon: '🐦',
      dateEarned: '2023-01-15',
    },
  ]);

  // Calculate completion percentages
  const totalCompletionPercentage = Math.round((problemStats.solved / problemStats.total) * 100);
  const easyCompletionPercentage = Math.round((problemStats.easy.solved / problemStats.easy.total) * 100);
  const mediumCompletionPercentage = Math.round((problemStats.medium.solved / problemStats.medium.total) * 100);
  const hardCompletionPercentage = Math.round((problemStats.hard.solved / problemStats.hard.total) * 100);

  return (
    <div className="min-h-screen bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
      <div className="max-w-7xl mx-auto">
        {/* Profile Header */}
        <div className="bg-white shadow rounded-lg overflow-hidden mb-8">
          <div className="p-6 sm:p-8 border-b border-gray-200">
            <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between">
              <div className="flex items-center mb-4 sm:mb-0">
                <div className="h-20 w-20 rounded-full bg-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                  {user.username.substring(0, 2).toUpperCase()}
                </div>
                <div className="ml-4">
                  <h1 className="text-2xl font-bold text-gray-900">{user.username}</h1>
                  <p className="text-sm text-gray-500">Joined {user.joinDate}</p>
                </div>
              </div>
              <div className="flex flex-wrap gap-4">
                <div className="text-center">
                  <p className="text-sm font-medium text-gray-500">Rank</p>
                  <p className="text-xl font-semibold text-gray-900">#{user.rank}</p>
                </div>
                <div className="text-center">
                  <p className="text-sm font-medium text-gray-500">Streak</p>
                  <p className="text-xl font-semibold text-gray-900">{user.streak} days 🔥</p>
                </div>
                <div className="text-center">
                  <p className="text-sm font-medium text-gray-500">Contributions</p>
                  <p className="text-xl font-semibold text-gray-900">{user.contributions}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          {/* Problem Stats */}
          <div className="lg:col-span-2">
            <div className="bg-white shadow rounded-lg overflow-hidden mb-8">
              <div className="p-6">
                <h2 className="text-lg font-semibold text-gray-900 mb-4">Problem Solving Progress</h2>
                <div className="mb-6">
                  <div className="flex justify-between mb-1">
                    <span className="text-sm font-medium text-gray-700">All Problems</span>
                    <span className="text-sm font-medium text-gray-700">{problemStats.solved} / {problemStats.total}</span>
                  </div>
                  <div className="w-full bg-gray-200 rounded-full h-2.5">
                    <div className="bg-indigo-600 h-2.5 rounded-full" style={{ width: `${totalCompletionPercentage}%` }}></div>
                  </div>
                  <p className="text-xs text-gray-500 mt-1">{totalCompletionPercentage}% completed</p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                  {/* Easy Problems */}
                  <div>
                    <div className="flex justify-between mb-1">
                      <span className="text-sm font-medium text-green-600">Easy</span>
                      <span className="text-sm font-medium text-gray-700">{problemStats.easy.solved} / {problemStats.easy.total}</span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2.5">
                      <div className="bg-green-500 h-2.5 rounded-full" style={{ width: `${easyCompletionPercentage}%` }}></div>
                    </div>
                    <p className="text-xs text-gray-500 mt-1">{easyCompletionPercentage}% completed</p>
                  </div>

                  {/* Medium Problems */}
                  <div>
                    <div className="flex justify-between mb-1">
                      <span className="text-sm font-medium text-yellow-600">Medium</span>
                      <span className="text-sm font-medium text-gray-700">{problemStats.medium.solved} / {problemStats.medium.total}</span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2.5">
                      <div className="bg-yellow-500 h-2.5 rounded-full" style={{ width: `${mediumCompletionPercentage}%` }}></div>
                    </div>
                    <p className="text-xs text-gray-500 mt-1">{mediumCompletionPercentage}% completed</p>
                  </div>

                  {/* Hard Problems */}
                  <div>
                    <div className="flex justify-between mb-1">
                      <span className="text-sm font-medium text-red-600">Hard</span>
                      <span className="text-sm font-medium text-gray-700">{problemStats.hard.solved} / {problemStats.hard.total}</span>
                    </div>
                    <div className="w-full bg-gray-200 rounded-full h-2.5">
                      <div className="bg-red-500 h-2.5 rounded-full" style={{ width: `${hardCompletionPercentage}%` }}></div>
                    </div>
                    <p className="text-xs text-gray-500 mt-1">{hardCompletionPercentage}% completed</p>
                  </div>
                </div>
              </div>
            </div>

            {/* Recent Submissions */}
            <div className="bg-white shadow rounded-lg overflow-hidden">
              <div className="p-6">
                <h2 className="text-lg font-semibold text-gray-900 mb-4">Recent Submissions</h2>
                <div className="overflow-x-auto">
                  <table className="min-w-full divide-y divide-gray-200">
                    <thead className="bg-gray-50">
                      <tr>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Problem</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Language</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Runtime</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Memory</th>
                        <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                      </tr>
                    </thead>
                    <tbody className="bg-white divide-y divide-gray-200">
                      {recentSubmissions.map((submission) => (
                        <tr key={submission.id}>
                          <td className="px-6 py-4 whitespace-nowrap">
                            <div className="flex items-center">
                              <div>
                                <div className="text-sm font-medium text-gray-900">{submission.problemName}</div>
                                <div className={
                                  `text-xs ${
                                    submission.difficulty === 'Easy' ? 'text-green-600' :
                                    submission.difficulty === 'Medium' ? 'text-yellow-600' : 'text-red-600'
                                  }`
                                }>
                                  {submission.difficulty}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap">
                            <span className={
                              `px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                                submission.status === 'Accepted' ? 'bg-green-100 text-green-800' :
                                submission.status === 'Wrong Answer' ? 'bg-red-100 text-red-800' :
                                submission.status === 'Time Limit Exceeded' ? 'bg-yellow-100 text-yellow-800' :
                                'bg-gray-100 text-gray-800'
                              }`
                            }>
                              {submission.status}
                            </span>
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{submission.language}</td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{submission.runtime}</td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{submission.memory}</td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{submission.date}</td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          {/* Badges and Achievements */}
          <div className="lg:col-span-1">
            <div className="bg-white shadow rounded-lg overflow-hidden">
              <div className="p-6">
                <h2 className="text-lg font-semibold text-gray-900 mb-4">Badges & Achievements</h2>
                <div className="space-y-4">
                  {badges.map((badge) => (
                    <div key={badge.id} className="flex items-start p-4 border border-gray-200 rounded-lg">
                      <div className="flex-shrink-0 h-12 w-12 bg-indigo-100 rounded-full flex items-center justify-center text-2xl">
                        {badge.icon}
                      </div>
                      <div className="ml-4">
                        <h3 className="text-md font-medium text-gray-900">{badge.name}</h3>
                        <p className="text-sm text-gray-500">{badge.description}</p>
                        <p className="text-xs text-gray-400 mt-1">Earned on {badge.dateEarned}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Profile;