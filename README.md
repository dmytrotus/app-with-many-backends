## Application with many backends

The plan is to create an app with one frontend and many backends in different programming languages: php, python, java. And compare it.

## How to make separate containers work
- create network:
```bash
docker network create shared_network_many_backends
```

```bash
docker network connect shared_network_many_backends app-many-backends-nextjs-front
```
```bash
docker network connect shared_network_many_backends app-many-backends-laravel-nginx
```

```bash
docker network inspect shared_network_many_backends
```

This last command needs to show something like

```bash
[
    {
        "Name": "shared_network_many_backends",
        "Id": "e98c43418d4c71304df879093abdf2f2d3a78fb44455fc555198e886730d962b",
        "Created": "2024-11-17T10:27:24.082481959Z",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": {},
            "Config": [
                {
                    "Subnet": "172.26.0.0/16",
                    "Gateway": "172.26.0.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Containers": {
            "10c091715f1b364f189b753932031ecf9477df4c3700b5a5a5ca7634ec1bee33": {
                "Name": "app-many-backends-nextjs-front",
                "EndpointID": "ef2d79506f40ff0a263d68ae14d16557b84cf1784e0f3eece868b65fcd8f964e",
                "MacAddress": "02:42:ac:1a:00:02",
                "IPv4Address": "172.26.0.2/16",
                "IPv6Address": ""
            },
            "ba331986016f3c3fce6a9bd0a95ad2f26f9fb00624ba5dea6dc4798bc41ea90b": {
                "Name": "app-many-backends-laravel-nginx",
                "EndpointID": "14566afbc76667965f0a065890c1b2deb729acfcb4bab75eeebde5bac082d8a2",
                "MacAddress": "02:42:ac:1a:00:03",
                "IPv4Address": "172.26.0.3/16",
                "IPv6Address": ""
            }
        },
        "Options": {},
        "Labels": {}
    }
]
```

Make sure that containers object has all containers and the name is correct.
Later, when we create the request we need to use
1. Container name as host (http://app-many-backends-laravel-nginx)
2. Internal docker port as port. In my case port is 80 because in backend/docker-compose.yml I have "3111:80"