
import React, { useState } from 'react';
import { useQuery, gql } from '@apollo/client';
import CharacterModal from './CharacterModal';
import './CharacterTable.css';



interface OriginLocation {
  id: string;
  name: string;
  type: string;
  dimension: string;
}

interface Character {
  id: string;
  name: string;
  status: string;
  species: string;
  type: string;
  gender: string;
  origin: OriginLocation;
  location: OriginLocation;
  image: string;
  created: string;
}

interface CharactersData {
  characters: {
    info: {
      count: number;
      pages: number;
      next: number | null;
      prev: number | null;
    };
    results: Character[];
  };
}

const GET_CHARACTERS = gql`
  query GetCharacters($page: Int) {
    characters(page: $page) {
      info {
        count
        pages
        next
        prev
      }
      results {
        id
        name
        status
        species
        type
        gender
        origin {
          id
          name
          type
          dimension
        }
        location {
          id
          name
          type
          dimension
        }
        image
        created
      }
    }
  }
`;

const CharacterTable: React.FC = () => {
  const [currentPage, setCurrentPage] = useState<number>(1);
  const [selectedCharacter, setSelectedCharacter] = useState<Character | null>(null);

  const { loading, error, data } = useQuery<CharactersData>(GET_CHARACTERS, {
    variables: { page: currentPage },
    fetchPolicy: 'cache-and-network', 
  });

  if (loading) return <div className="spinner"></div>;
  if (error) return <p>Error :(</p>;

  if (!data || !data.characters) return <p>No characters found!</p>;

  const handlePageChange = (direction: number) => {
    const newPage = Math.max(1, Math.min(Math.ceil(data.characters.info.count / 10), currentPage + direction));
    setCurrentPage(newPage);
  };

  const handleViewClick = (character: Character) => {
    setSelectedCharacter(character);
  };

  const handleCloseModal = () => {
    setSelectedCharacter(null);
  };

  return (
    <div>
      <h2>Character List</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Species</th>
            <th>Type</th>
            <th>Gender</th>
            <th>Origin</th>
            <th>Location</th>
            <th>Image</th>
            <th>Created</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          {data.characters.results.map((character) => (
            <tr key={character.id}>
              <td>{character.name}</td>
              <td>{character.status}</td>
              <td>{character.species}</td>
              <td>{character.type}</td>
              <td>{character.gender}</td>
              <td>{character.origin.name} ({character.origin.type})</td>
              <td>{character.location.name} ({character.location.type})</td>
              <td><img src={character.image} alt={character.name} width="50" /></td>
              <td>{new Date(character.created).toLocaleDateString()}</td>
              <td>
                <button onClick={() => handleViewClick(character)}>View</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <div className="pagination-container">
        <div className="pagination">
          <button className="pagination-item" disabled={!data.characters.info.prev} onClick={() => handlePageChange(-1)}>
            Previous
          </button>
          <span className="pagination-item">Showing {currentPage * 10} of {data.characters.info.count} results</span>
          <button className="pagination-item" disabled={!data.characters.info.next} onClick={() => handlePageChange(1)}>
            Next
          </button>
        </div>
        {selectedCharacter && (
          <CharacterModal character={selectedCharacter} onClose={handleCloseModal} />
        )}
      </div>
    </div>
  );
};

export default CharacterTable;