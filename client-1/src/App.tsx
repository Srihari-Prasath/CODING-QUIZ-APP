import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import ProfilePage from './pages/ProfilePage';

const App: React.FC = () => {
  return (
    <Router>
      <Switch>
        <Route path="/profile" component={ProfilePage} />
        {/* Add other routes here */}
      </Switch>
    </Router>
  );
};

export default App;