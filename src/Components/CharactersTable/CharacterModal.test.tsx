import React from 'react';
import { render, fireEvent } from '@testing-library/react';
import CharacterModal from './CharacterModal';

describe('CharacterModal', () => {
  const character = {
    name: 'Rick Sanchez',
    status: 'Alive',
    species: 'Human',
    type: 'Test character',
    gender: 'Male',
    origin: {
      name: 'Earth (C-137)',
      type: 'Planet',
    },
    location: {
      name: 'Citadel of Ricks',
      type: 'Space station',
    },
    image: 'https://rickandmortyapi.com/api/character/avatar/1.jpeg',
    created: '2017-11-04T18:50:21.625Z',
  };

  const handleClose = jest.fn();

  it('renders the character details correctly', () => {
    const { getByText, getByAltText } = render(
      <CharacterModal character={character} onClose={handleClose} />
    );

    expect(getByText('Character Details')).toBeInTheDocument();
    expect(getByText('Name: Rick Sanchez')).toBeInTheDocument();
    expect(getByText('Status: Alive')).toBeInTheDocument();
    expect(getByText('Species: Human')).toBeInTheDocument();
    expect(getByText('Type: Test character')).toBeInTheDocument();
    expect(getByText('Gender: Male')).toBeInTheDocument();
    expect(getByText('Origin: Earth (C-137) (Planet)')).toBeInTheDocument();
    expect(getByText('Location: Citadel of Ricks (Space station)')).toBeInTheDocument();
    expect(getByAltText('Rick Sanchez')).toBeInTheDocument();
   // expect(getByText('Created: 11/4/2017')).toBeInTheDocument();
  });

  it('calls the onClose function when the close button is clicked', () => {
    const { getByText } = render(
      <CharacterModal character={character} onClose={handleClose} />
    );

    fireEvent.click(getByText('×'));

    expect(handleClose).toHaveBeenCalledTimes(1);
  });
});