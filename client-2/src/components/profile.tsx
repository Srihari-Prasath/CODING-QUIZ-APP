import React from 'react';
import { User } from '../types/user';

interface ProfileProps {
  user: User;
  onEdit: () => void;
}

const Profile: React.FC<ProfileProps> = ({ user, onEdit }) => {
  return (
    <div className="profile">
      <h1>{user.name}'s Profile</h1>
      <p>Email: {user.email}</p>
      <h2>Quiz Statistics</h2>
      <p>Quizzes Taken: {user.quizScores.length}</p>
      <p>Average Score: {user.quizScores.reduce((a, b) => a + b, 0) / user.quizScores.length || 0}</p>
      <button onClick={onEdit}>Edit Profile</button>
    </div>
  );
};

export default Profile;