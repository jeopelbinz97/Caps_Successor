import { useEffect } from "react";
import { useNavigate, useLocation } from "react-router-dom";
import useToast from "../hooks/useToast";
import LoadingOverlay from "../components/loadingOverlay";

export default function GoogleCallback() {
  const navigate = useNavigate();
  const location = useLocation();
  const { showToast } = useToast();
  const apiUrl = import.meta.env.VITE_API_BASE_URL;

  useEffect(() => {
    const handleGoogleLogin = () => {
      // Extract the token and user parameters from the URL query string
      const searchParams = new URLSearchParams(location.search);
      const token = searchParams.get("token");
      const userStr = searchParams.get("user");
      const error = searchParams.get("error");

      if (error) {
        showToast(error, "error");
        navigate("/");
        return;
      }

      if (!token || !userStr) {
        showToast("Authentication failed. Missing token or user data.", "error");
        navigate("/");
        return;
      }

      try {
        const userObj = JSON.parse(decodeURIComponent(userStr));
        
        localStorage.setItem("token", token);
        localStorage.setItem("user", JSON.stringify(userObj));

        showToast("Logged in with Google successfully!", "success");

        // Role-based redirect via window.location to force a re-mount and context hydration
        const roleId = Number(userObj.roleID);
        switch (roleId) {
          case 1:
            window.location.href = "/student-dashboard";
            break;
          case 2:
            window.location.href = "/faculty-dashboard";
            break;
          case 3:
            window.location.href = "/program-chair-dashboard";
            break;
          case 4:
            window.location.href = "/dean-dashboard";
            break;
          case 5:
            window.location.href = "/asso-dean-dashboard";
            break;
          default:
            showToast("Invalid user role.", "error");
            window.location.href = "/";
            break;
        }

      } catch (err) {
        showToast("Something went wrong processing Google Login data.", "error");
        navigate("/");
      }
    };

    handleGoogleLogin();
  }, [location, navigate, showToast, apiUrl]);

  return <LoadingOverlay />;
}
