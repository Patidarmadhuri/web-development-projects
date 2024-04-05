// Import gql tag from @apollo/client
import { gql } from '@apollo/client';


export const GET_CHARACTERS = gql`
  query GetCharacters($skip: Int!, $first: Int!) {
    characters(skip: $skip, first: $first) {
      info {
        count
      }
      results {
        id
        name
        species
        status
        origin {
          name
        }
        location {
          name
        }
        image
        url
        created
      }
    }
  }
`;

// Episode query
export const GET_EPISODES = gql`
  query GetEpisodes($skip: Int!, $first: Int!) {
    episodes(skip: $skip, first: $first) {
      info {
        count
      }
      results {
        id
        name
        air_date
        episode
        characters {
          id
          name
        }
        created
        url
        season
      }
    }
  }
`;

// Location query
export const GET_LOCATIONS = gql`
  query GetLocations($skip: Int!, $first: Int!) {
    locations(skip: $skip, first: $first) {
      info {
        count
      }
      results {
        id
        name
        type
        dimension
        residents {
          id
          name
        }
        url
        created
      }
    }
  }
`;