import React from 'react';


interface CharacterModalProps {
  character: any;
  onClose: () => void;
}

const CharacterModal: React.FC<CharacterModalProps> = ({ character, onClose }) => {
  return (
    <div className="modal">
      <div className="modal-content">
        <span className="close" onClick={onClose}>
          &times;
        </span>
        <h2>Character Details</h2>
        <p>Name: {character.name}</p>
        <p>Status: {character.status}</p>
        <p>Species: {character.species}</p>
        <p>Type: {character.type}</p>
        <p>Gender: {character.gender}</p>
        <p>Origin: {character.origin.name} ({character.origin.type})</p>
        <p>Location: {character.location.name} ({character.location.type})</p>
        <img src={character.image} alt={character.name} />
        <p>Created: {new Date(character.created).toLocaleDateString()}</p>
      </div>
    </div>
  );
};

export default CharacterModal;