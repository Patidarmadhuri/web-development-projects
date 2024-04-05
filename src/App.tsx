import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import CharactersTable from './Components/CharactersTable/CharactersTable';


function App() {
  return (
    <Router>
      <div>
        <h1>Rick & Morty Characters</h1>
        <Routes>
          <Route  path="/" element={<CharactersTable />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;