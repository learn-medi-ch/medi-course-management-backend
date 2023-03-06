FROM node:19-alpine AS build

COPY app /build/medi-course-management-backend/app

RUN chmod +x /build/medi-course-management-backend/app/bin/install-libraries.sh
RUN /build/medi-course-management-backend/app/bin/install-libraries.sh

FROM node:19-alpine AS medi-course-management-backend

COPY --from=build /build /opt/

RUN chown -R node:node /opt/medi-course-management-backend
RUN chmod +x /opt/medi-course-management-backend/app/docker-entrypoint.sh
RUN /opt/medi-course-management-backend/app/docker-entrypoint.sh


USER node:node

EXPOSE 3100

ENV SERVER_HOST=localhost
ENV SERVER_PORT=3200
ENV DATABASE_PORT=""
ENV DATABASE_HOST=""
ENV DATABASE_DATABASE=""
ENV DATABASE_PASSWORD=""
ENV DATABASE_USER=""
ENV SERVER_REQUIRED_HEADERS=x-flux-ilias-rest-api-user-id
ENV SERVER_ALLOWED_IPS=""


WORKDIR /opt/medi-course-management-backend/app
ENTRYPOINT ["/opt/medi-course-management-backend/app/docker-entrypoint.sh"]