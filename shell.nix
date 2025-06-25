{ pkgs ? import <nixpkgs> {} }:

pkgs.mkShell {
  buildInputs = [
    pkgs.php
    pkgs.phpPackages.composer
    pkgs.phpPackages.swoole
  ];
}