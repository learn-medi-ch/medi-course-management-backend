#!/bin/bash
docker build --no-cache ../../ -f Dockerfile --pull --target medi-course-management-backend -t medi-course-management/backend:$(basename "$PWD")