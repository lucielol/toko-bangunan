import React, { useEffect, useState } from "react";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import { NavLink } from "react-router-dom";

const Users = () => {
  const [userData, setUserData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [selectedUser, setSelectedUser] = useState(null);
  const [showModal, setShowModal] = useState(false);
  const [isEditing, setIsEditing] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(
          "http://localhost:8080/api?action=getUsers"
        );
        console.log(response.data);
        setUserData(response.data);
      } catch (error) {
        console.error("Error fetching user data:", error);
        setError("Failed to load user data.");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  const handleShowModal = (user) => {
    setSelectedUser(user);
    setIsEditing(true);
    setShowModal(true);
  };

  const handleShowAddModal = () => {
    setSelectedUser(null);
    setIsEditing(false);
    setShowModal(true);
  };

  const handleCloseModal = () => {
    setShowModal(false);
    setSelectedUser(null);
  };

  const handleSave = async (e) => {
    e.preventDefault();
    const { username, email, nama_lengkap, nomor_telepon, alamat, password } =
      e.target.elements;

    try {
      if (isEditing) {
        await axios.put("http://localhost:8080/api?action=updateUser", {
          id: selectedUser.id,
          username: username.value,
          email: email.value,
          nama_lengkap: nama_lengkap.value,
          nomor_telepon: nomor_telepon.value,
          alamat: alamat.value,
          password: password.value,
        });
      } else {
        await axios.post("http://localhost:8080/api?action=register", {
          username: username.value,
          email: email.value,
          nama_lengkap: nama_lengkap.value,
          nomor_telepon: nomor_telepon.value,
          alamat: alamat.value,
          password: password.value,
        });
      }

      const response = await axios.get(
        "http://localhost:8080/api?action=getUsers"
      );
      setUserData(response.data);
      handleCloseModal();
    } catch (error) {
      console.error(`Error ${isEditing ? "updating" : "adding"} user:`, error);
      setError(`Failed to ${isEditing ? "update" : "add"} user.`);
    }
  };

  const handleDelete = async (id) => {
    try {
      await axios.delete(
        `http://localhost:8080/api?action=deleteUser&id=${id}`
      );
      const response = await axios.get(
        "http://localhost:8080/api?action=getUsers"
      );
      setUserData(response.data);
    } catch (error) {
      console.error("Error deleting user:", error);
      setError("Failed to delete user.");
    }
  };

  if (loading) {
    return <div className="text-center">Loading...</div>;
  }

  return (
    <div className="container-fluid mt-5">
      <h2 className="text-center mb-4">
        <NavLink to="/dashboard" className="decoration-non">
          Kembali
        </NavLink>{" "}
        - Manage Users
      </h2>
      {error && (
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      )}
      <button className="btn btn-success mb-4" onClick={handleShowAddModal}>
        Add User
      </button>
      <div className="row">
        <div className="col-12">
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th>Nomor Telpon</th>
                <th>Alamat</th>
                <th>Tanggal Dibuat</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {userData && userData.length > 0 ? (
                userData.map((user) => (
                  <tr key={user.id}>
                    <td>{user.id}</td>
                    <td>{user.username}</td>
                    <td>{user.email}</td>
                    <td>{user.nama_lengkap}</td>
                    <td>{user.nomor_telepon}</td>
                    <td>{user.alamat}</td>
                    <td>{user.tanggal_dibuat}</td>
                    <td>
                      <button
                        className="btn btn-primary"
                        onClick={() => handleShowModal(user)}
                      >
                        Edit
                      </button>{" "}
                      <button
                        className="btn btn-danger"
                        onClick={() => handleDelete(user.id)}
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="8" className="text-center">
                    No users found
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      <div
        className={`modal fade ${showModal ? "show" : ""}`}
        tabIndex="-1"
        style={{ display: showModal ? "block" : "none" }}
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div className="modal-dialog">
          <div className="modal-content">
            <div className="modal-header">
              <h5 className="modal-title" id="exampleModalLabel">
                {isEditing ? "Edit User" : "Add User"}
              </h5>
              <button
                type="button"
                className="btn-close"
                onClick={handleCloseModal}
                aria-label="Close"
              ></button>
            </div>
            <div className="modal-body">
              <form onSubmit={handleSave}>
                <div className="mb-3">
                  <label htmlFor="username" className="form-label">
                    Username
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="username"
                    defaultValue={selectedUser ? selectedUser.username : ""}
                    name="username"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="email" className="form-label">
                    Email
                  </label>
                  <input
                    type="email"
                    className="form-control"
                    id="email"
                    defaultValue={selectedUser ? selectedUser.email : ""}
                    name="email"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="nama_lengkap" className="form-label">
                    Nama Lengkap
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="nama_lengkap"
                    defaultValue={selectedUser ? selectedUser.nama_lengkap : ""}
                    name="nama_lengkap"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="nomor_telepon" className="form-label">
                    Nomor Telepon
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="nomor_telepon"
                    defaultValue={
                      selectedUser ? selectedUser.nomor_telepon : ""
                    }
                    name="nomor_telepon"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="alamat" className="form-label">
                    Alamat
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="alamat"
                    defaultValue={selectedUser ? selectedUser.alamat : ""}
                    name="alamat"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="password" className="form-label">
                    Password
                  </label>
                  <input
                    type="password"
                    className="form-control"
                    id="password"
                    name="password"
                    required={!isEditing}
                  />
                  {isEditing && (
                    <small className="form-text text-muted">
                      Leave blank if you don't want to change the password.
                    </small>
                  )}
                </div>
                <button type="submit" className="btn btn-primary">
                  {isEditing ? "Save Changes" : "Add User"}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Users;
