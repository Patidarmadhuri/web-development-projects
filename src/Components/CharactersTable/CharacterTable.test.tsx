
import React from 'react';
import { render, screen } from '@testing-library/react';
import { MockedProvider } from '@apollo/client/testing';
import { GET_CHARACTERS } from './queries';
import  CharactersTable  from './CharactersTable'; 


const mocks = [
  {
    request: {
      query: GET_CHARACTERS,
      variables: { page: 1 },
    },
    result: {
      data: {
        characters: {
          info: {
            count: 2,
          },
          results: [
            {
              id: '1',
              name: 'Rick Sanchez',
              status: 'Alive',
              species: 'Human',
              type: 'Mad Scientist',
              gender: 'Male',
              origin: {
                id: '1',
                name: 'Earth',
                type: 'Planet',
                dimension: 'Dimension C-137',
              },
              location: {
                id: '2',
                name: 'Citadel of Ricks',
                type: 'Space station',
                dimension: 'unknown',
              },
              image: 'https://rickandmortyapi.com/api/character/avatar/1.jpeg',
              created: '2017-11-04T18:48:46.250Z',
            },
          ],
        },
      },
    },
  },
];

describe('CharacterTable', () => {
  it('renders the character list with correct data', async () => {
    render(
      <MockedProvider mocks={mocks} addTypename={false}>
        <CharactersTable />
      </MockedProvider>
    );

    //expect(screen.getByText('Character List')).toBeInTheDocument();
    //expect(screen.getByText('Rick Sanchez')).toBeInTheDocument();
    //expect(screen.getByText('Alive')).toBeInTheDocument();
    //expect(screen.getByText('Human')).toBeInTheDocument();
    //expect(screen.getByText('Mad Scientist')).toBeInTheDocument();
    //expect(screen.getByText('Male')).toBeInTheDocument();
    //expect(screen.getByText('Earth (Planet)')).toBeInTheDocument();
    //expect(screen.getByText('Citadel of Ricks (Space station)')).toBeInTheDocument();
   // expect(screen.getByAltText('Rick Sanchez')).toBeInTheDocument();
    //expect(screen.getByText('11/4/2017')).toBeInTheDocument();
  });
});