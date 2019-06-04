<?php


namespace App\Service;


class GitHubGraphQL
{
    // Récupérer les infos d'un profil github
    public function getProfileInfo($login) {
        // GRAPHQL
        $query = <<<'GRAPHQL'
query GetUser($user: String!) {
   user (login: $user) {
    name
    email
    avatarUrl
    bio
    repositoriesContributedTo {
      totalCount
    }
  }
}
GRAPHQL;

        $datas = $this->graphql_query('https://api.github.com/graphql',$query,['user'=>$login],'ce9930e52c686cfe2a5db831bb1031ed0365fda9');

        return $datas;
    }

    private function graphql_query(string $endpoint, string $query, array $variables = [], ?string $token = null): array
    {
        $headers = ['Content-Type: application/json', 'User-Agent: Dunglas\'s minimal GraphQL client'];
        if (null !== $token) {
            $headers[] = "Authorization: bearer $token";
        }
        if (false === $data = @file_get_contents($endpoint, false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                    'content' => json_encode(['query' => $query, 'variables' => $variables]),
                ]
            ]))) {
            $error = error_get_last();
            throw new \ErrorException($error['message'], $error['type']);
        }
        return json_decode($data, true);
    }
}