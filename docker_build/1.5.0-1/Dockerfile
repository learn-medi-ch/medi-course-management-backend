FROM fluxms/flux-eco-biotope:1.4.0 AS medi-course-management-backend
USER root
COPY --chown=www-data:www-data ./app /app
RUN (mkdir -p /app/libs/flux-ilias-rest-api-client && cd /app/libs/flux-ilias-rest-api-client && wget -O - https://github.com/fluxfw/flux-ilias-rest-api-client/releases/download/v2022-08-02-1/flux-ilias-rest-api-client-v2022-08-02-1-build.tar.gz | tar -xz --strip-components=1)

USER www-data
WORKDIR /app

ENV FLUX_ILIAS_REST_API_CLIENT_URL='http://nginx'
ENV FLUX_ILIAS_REST_API_CLIENT_USER='api'

ENV SWOOLE_HTTP_PORT=9501
ENV SWOOLE_HTTP_MESSAGE_RECEIVER_PORT=9502
ENV SWOOLE_HTTP_WORKER_NUM=10
ENV SWOOLE_HTTP_MAX_CONN=100
ENV SWOOLE_HTTP_MAX_REQUEST=500
ENV SWOOLE_HTTP_IPC_MODE=2
ENV SWOOLE_HTTP_TASK_WORKER_NUM=10
ENV SWOOLE_HTTP_TASK_IPC_MODE=2
ENV SWOOLE_HTTP_TASK_MAX_REQUEST=100
ENV SWOOLE_HTTP_DISPATCH_MODE=2
ENV SWOOLE_HTTP_DAEMONIZE=0
ENV SWOOLE_HTTP_BACKLOG=2048
ENV SWOOLE_HTTP_OPEN_TCP_KEEPALIVE=1
ENV SWOOLE_HTTP_TCP_DEFER_ACCEPT=5
ENV SWOOLE_HTTP_OPEN_TCP_NODELAY=1

ENV SWOOLE_HTTP_LOG_FILE_PATH_NAME=/opt/medi-course-management-backend/logs/http.log
ENV ILIAS_URL=https://learn.medi.ch
ENV ILIAS_CLIENT=medi01

ENTRYPOINT ["sh", "./docker_entrypoint.sh"]
