import React from "react";
import { render, screen } from "@testing-library/react";
import App  from "./App";
import { MockedProvider, MockedResponse } from "@apollo/client/testing";
import { GET_CHARACTERS } from './Components/CharactersTable/queries';
import CharacterTable from "./Components/CharactersTable/CharactersTable";


const mocks: MockedResponse[] = [

  {
    request: {
      query: GET_CHARACTERS,
      variables: { page: 1, pageSize: 10 },
    },
    result: {
      data: {
        characters: {
          info: {
            count: 3,
            pages: 1,
            next: null,
            prev: null,
          },
          results: [
            {
              id: 1,
              name: 'Rick Sanchez',
              status: 'Alive',
              species: 'Human',
              type: '',
              gender: 'Male',
              origin: { name: 'Earth (C-137)' },
              location: { name: 'Earth (C-137)' },
              image: 'https://rickandmortyapi.com/api/character/avatar/1.jpeg',
              episode: [
                'S01E01', 'S01E02', 'S01E03', 'S01E04', 'S01E05', 'S01E06', 'S01E07', 'S01E08', 'S01E09', 'S01E10', 'S01E11', 'S01E12', 'S01E13', 'S01E14', 'S01E15', 'S01E16', 'S01E17', 'S01E18', 'S01E19', 'S01E20', 'S01E21', 'S01E22', 'S01E23', 'S01E24', 'S01E25', 'S01E26', 'S01E27', 'S01E28', 'S01E29', 'S01E30', 'S01E31', 'S01E32', 'S01E33', 'S01E34', 'S01E35', 'S01E36', 'S01E37', 'S01E38', 'S01E39', 'S01E40', 'S01E41', 'S01E42', 'S01E43', 'S01E44', 'S01E45', 'S01E46', 'S01E47', 'S01E48', 'S01E49', 'S01E50', 'S01E51', 'S01E52', 'S01E53', 'S01E54', 'S01E55', 'S01E56', 'S01E57', 'S01E58', 'S01E59', 'S01E60', 'S01E61', 'S01E62', 'S01E63', 'S01E64', 'S01E65', 'S01E66', 'S01E67', 'S01E68', 'S01E69', 'S01E70', 'S01E71', 'S01E72', 'S01E73', 'S01E74', 'S01E75', 'S01E76', 'S01E77', 'S01E78', 'S01E79', 'S01E80', 'S01E81', 'S01E82', 'S01E83', 'S01E84', 'S01E85', 'S01E86', 'S01E87', 'S01E88', 'S01E89', 'S01E90', 'S01E91', 'S',
                   ]
            }
          ]
          }
        }
   
       }   }

];

test("renders boilerplate", () => {
  render(
    <MockedProvider mocks={mocks} addTypename={false}>
      <App />
    </MockedProvider>
  );
  const header = screen.getByRole("heading", {
    name: /rick & morty characters/i,
  });
  expect(header).toBeInTheDocument();
});
export {}