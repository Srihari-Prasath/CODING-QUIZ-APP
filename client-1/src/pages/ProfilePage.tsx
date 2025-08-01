import React, { useEffect, useState } from 'react';
import Profile from '../components/profile';
import { User } from '../types/user';

const ProfilePage: React.FC = () => {
    const [user, setUser] = useState<User | null>(null);
    const [loading, setLoading] = useState<boolean>(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchUserData = async () => {
            try {
                const response = await fetch('/api/user'); // Adjust the API endpoint as necessary
                if (!response.ok) {
                    throw new Error('Failed to fetch user data');
                }
                const data: User = await response.json();
                setUser(data);
            } catch (err) {
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchUserData();
    }, []);

    if (loading) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>Error: {error}</div>;
    }

    return (
        <div>
            {user ? <Profile user={user} /> : <div>No user data available</div>}
        </div>
    );
};

export default ProfilePage;