#!/bin/bash
docker build ../../ -f Dockerfile --target medi-course-management-backend -t medi-course-management/backend:$(basename "$PWD")