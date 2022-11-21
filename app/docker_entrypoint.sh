#!/bin/sh
set -e

function printBanner {
  echo "..., Doc. Are You Telling Me You Built A Time Machine...Out Of PHP?";
}

function startServer {
  php /app/bin/server.php
}

printBanner
startServer