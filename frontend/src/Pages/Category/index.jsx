import React, { useEffect, useState } from "react";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import { NavLink } from "react-router-dom";

const Categories = () => {
  const [categoryData, setCategoryData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [showModal, setShowModal] = useState(false);
  const [isEditing, setIsEditing] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(
          "http://localhost:8080/api?action=getCategories"
        );
        setCategoryData(response.data);
      } catch (error) {
        console.error("Error fetching category data:", error);
        setError("Failed to load category data.");
      } finally {
        setLoading(false);
        setSelectedCategory(null);
      }
    };

    fetchData();
  }, []);

  const handleShowModal = (category) => {
    setSelectedCategory(category);
    setIsEditing(true);
    setShowModal(true);
  };

  const handleShowAddModal = () => {
    setSelectedCategory(null);
    setIsEditing(false);
    setShowModal(true);
  };

  const handleCloseModal = () => {
    setShowModal(false);
    setSelectedCategory(null);
  };

  const handleSave = async (e) => {
    e.preventDefault();
    const { nama_kategori, deskripsi } = e.target.elements;

    try {
      if (isEditing) {
        await axios.put("http://localhost:8080/api?action=updateCategory", {
          id: selectedCategory.id,
          nama_kategori: nama_kategori.value,
          deskripsi: deskripsi.value,
        });
      } else {
        await axios.post("http://localhost:8080/api?action=addCategory", {
          nama_kategori: nama_kategori.value,
          deskripsi: deskripsi.value,
        });
      }

      const response = await axios.get(
        "http://localhost:8080/api?action=getCategories"
      );
      setCategoryData(response.data);
      handleCloseModal();
    } catch (error) {
      console.error(
        `Error ${isEditing ? "updating" : "adding"} category:`,
        error
      );
      setError(`Failed to ${isEditing ? "update" : "add"} category.`);
    } finally {
      setSelectedCategory(null);
    }
  };

  const handleDelete = async (id) => {
    try {
      await axios.delete(
        `http://localhost:8080/api?action=deleteCategory&id=${id}`
      );
      const response = await axios.get(
        "http://localhost:8080/api?action=getCategories"
      );
      setCategoryData(response.data);
    } catch (error) {
      console.error("Error deleting category:", error);
      setError("Failed to delete category.");
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
        - Manage Categories
      </h2>
      {error && (
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      )}
      <button className="btn btn-success mb-4" onClick={handleShowAddModal}>
        Add Category
      </button>
      <div className="row">
        <div className="col-12">
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {categoryData && categoryData.length > 0 ? (
                categoryData.map((category, index) => (
                  <tr key={index}>
                    <td>{index + 1}</td>
                    <td>{category.nama_kategori}</td>
                    <td>{category.deskripsi}</td>
                    <td>
                      <button
                        className="btn btn-primary"
                        onClick={() => handleShowModal(category)}
                      >
                        Edit
                      </button>{" "}
                      <button
                        className="btn btn-danger"
                        onClick={() => handleDelete(category.id)}
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="4" className="text-center">
                    No categories found
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
                {isEditing ? "Edit Category" : "Add Category"}
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
                  <label htmlFor="nama_kategori" className="form-label">
                    Nama Kategori
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="nama_kategori"
                    defaultValue={
                      selectedCategory ? selectedCategory.nama_kategori : ""
                    }
                    name="nama_kategori"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="deskripsi" className="form-label">
                    Deskripsi
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="deskripsi"
                    defaultValue={
                      selectedCategory ? selectedCategory.deskripsi : ""
                    }
                    name="deskripsi"
                    required
                  />
                </div>
                <button type="submit" className="btn btn-primary">
                  {isEditing ? "Save Changes" : "Add Category"}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Categories;
