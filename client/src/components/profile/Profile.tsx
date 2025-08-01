import React from 'react';

interface UserProfile {
  name: string;
  department: string;
  rollNumber: string;
  currentYear: string;
  email: string;
}

interface ProfileProps {
  user: UserProfile;
}

const Profile: React.FC<ProfileProps> = ({ user }) => {
  return (
    <div className="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
      <div className="p-8">
        <h1 className="text-2xl font-bold text-gray-900 mb-4">Student Profile</h1>
        <div className="space-y-4">
          <div>
            <label className="text-sm font-medium text-gray-500">Name</label>
            <p className="text-lg font-semibold text-gray-900">{user.name}</p>
          </div>
          <div>
            <label className="text-sm font-medium text-gray-500">Department</label>
            <p className="text-lg font-semibold text-gray-900">{user.department}</p>
          </div>
          <div>
            <label className="text-sm font-medium text-gray-500">Roll Number</label>
            <p className="text-lg font-semibold text-gray-900">{user.rollNumber}</p>
          </div>
          <div>
            <label className="text-sm font-medium text-gray-500">Current Year</label>
            <p className="text-lg font-semibold text-gray-900">{user.currentYear}</p>
          </div>
          <div>
            <label className="text-sm font-medium text-gray-500">Email</label>
            <p className="text-lg font-semibold text-gray-900">{user.email}</p>
          </div>
        </div>
        <div className="mt-6">
          <button
            className="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200"
            onClick={() => alert('Edit Profile functionality to be implemented')}
          >
            Edit Profile
          </button>
        </div>
      </div>
    </div>
  );
};

export default Profile;